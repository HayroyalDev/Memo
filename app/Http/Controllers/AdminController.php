<?php

namespace App\Http\Controllers;

use App\info;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function DashBoard()
    {
        if(Auth::check())
        {
            if(Auth::user()->is_admin)
            {
                $info = info::orderByDesc('id')->get();
                return view('admin.dashboard')->with(['title'=>'Admin','memo'=>$info]);
            }
            else{
                return redirect()->action('UserController@Dashboard');
            }
        }
        else{
            return redirect()->intended('/');
        }
    }
    function viewMemo(Request $request){
        return view('Admin.view_memo',['title' => 'View Memo','memo' => info::find($request->id)]);
    }
    function addMemo(Request $request){
        if($request->method() == "GET")
            return view('Admin.add_memo',[
                'title' => 'Add Memo',
                'user' => User::where('is_admin', false)->get()
            ]);
        if($request->method() == "POST"){
            //dd($request->all());
            $validator = Validator::make($request->all(), [
                    'to' => 'required',
                    'from' => 'required',
                    'subject' => 'required',
                    'message' => 'required'
                ]
            );
            if($validator->fails())
            {
                Session::flash('form-other-error','One or More incorrect field');
                Log::info('error',$validator->errors());
                return redirect()->back()->with(['title'=>'Users']);
            }else{
                $in = new Info();
                $in->_to = $request->to;
                $in->_from = $request->from;
                $in->subject = $request->subject;
                $in->message = $request->message;
                if($in->save()){
                    Session::flash('form-success','Memmo Sent Successfully');
                }else{
                    Session::flash('form-other-error','Unable To Send Memo.');
                }
                return redirect()->back();
            }
        }
    }
    function deleteMemo(Request $request){
        //dd($request->id);
        if(isset($request->id)){
            info::find($request->id)->delete();
            Session::flash('form-success','Memo Deleted Successfully');
        }
        return redirect()->back();
    }
    public function DashBoardPost(Request $request)
    {
        if($request->post_type == 1)
        {
            $validator = Validator::make($request->all(),
                [
                    'title' => 'required',
                    'body' => 'required',
                ]
            );
            if($validator->fails())
            {
                Session::flash('form-error',$validator->getMessageBag()->toArray());
                return redirect()->back()->with(['title'=>'Dashboard']);
            }
            else{
                $infos = new info();
                $infos->title = $request->title;
                $infos->body = $request->body;
                $infos->attachment = null;

                if($request->hasFile('attachment'))
                {
                    $file = Input::file('attachment');
                    $filename = time() . '.' .$file->getClientOriginalExtension();
                    $infos->attachment = $filename;
                    $request->file('attachment')->move(
                        base_path() . '/public/attachment/', $filename
                    );
                }
                $infos->uploaded_by = Auth::user()->id;
                if($infos->save())
                {
                    Session::flash('form-success','Information Added Successfully');
                    return redirect()->back()->with(['title'=>'Users','news' => info::all()]);
                }
                else{
                    Session::flash('form-other-error','Cannot Add User, Please try again');
                }
            }
        }
    }
    public function Downloads($did)
    {
        $info = info::find($did);
        $file= public_path(). "/attachment/".$info->attachment;
        return response()->file($file);
        //return response()->download($file);
    }
    public function Users()
    {
        if(Auth::check())
        {
            if(Auth::user()->is_admin)
            {
                $user = User::all();
                return view('admin.users')->with(['title'=>'Admin','users'=>$user]);
            }
            else{
                return redirect()->action('UserController@Dashboard');
            }
        }
        else{
            return redirect()->intended('/');
        }
    }
    public function userAction(Request $request){
        if(isset($request->type)){
            if($request->type == "add")
                return view('Admin.add_edit_user',['title' => 'Add User']);
            if($request->type == "edit"){
                $user = User::find($request->id);
                return view('Admin.add_edit_user',['title' => 'Edit User','edit' => 'edit','user' => $user]);
            }
            if($request->type == "delete"){
                User::find($request->id)->delete();
                Session::flash('form-success','User deleted successfully');
                return redirect()->back();
            }
        }
        Session::flash('error','Invalid request Type');
        return redirect()->back();
    }
    public function UsersPost(Request $request)
    {
        //dd($request->all(), $request->type);
        if($request->type == "edit"){
            $validator = Validator::make($request->all(),
                [
                    'email' => 'required',
                    'username' => 'required',
                ]
            );
            if($validator->fails())
            {
                //Session::flash('form-error',$validator->getMessageBag()->toArray());
                Session::flash('form-other-error','One or More incorrect field');
                return redirect()->back()->with(['title'=>'Users']);
            }
            else
            {
                $user = User::find($request->id);
                $user->email = $request->email;
                $user->username = $request->username;
                $user->password = bcrypt($request->password);
                $user->is_admin = $request->role;
                $user->is_active = $request->status;
                var_dump($user);
                if($user->save())
                {
                    Session::flash('form-success','User Edited Successfully');
                    return redirect()->route('admin.user.all');
                }
                else{
                    Session::flash('form-other-error','Cannot Edit User, Please try again');
                }
            }
        }


        if($request->type == "add")
        {

            $validator = Validator::make($request->all(),
                [
                    'email' => 'required',
                    'username' => 'required',
                    'password' => 'required',
                ]
            );
            if($validator->fails())
            {
                Session::flash('form-error',$validator->getMessageBag()->toArray());
                return redirect()->back()->with(['title'=>'Users']);
            }
            else{
                $user = new User();
                $user->email = $request->email;
                $user->username = $request->username;
                $user->password = Hash::make($request->password);
                $user->is_admin = $request->role;
                $user->is_active = $request->status;
                var_dump($user);
                if($user->save())
                {
                    Session::flash('form-success','User Added Successfully');
                    return redirect()->route('admin.user.all');
                }
                else{
                    Session::flash('form-other-error','Cannot Add User, Please try again');
                }
            }

        }

        return redirect()->back();
    }
}
