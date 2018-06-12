<?php

namespace App\Http\Controllers;

use App\info;
use App\MemoRead;
use App\messages;
use App\total_messages;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function SignIn()
    {
        return view('user.signin')->withTitle('Sign In');
    }

    public function SignOut()
    {
        Auth::logout();
        return \redirect()->action('UserController@SignIn');
    }

    public function AuthenticateUser(Request $request)
    {
        if(Auth::attempt(Input::only("username","password")))
        {
            if(Auth::user()->is_admin)
            {
                return redirect()->action('AdminController@DashBoard');
            }
            elseif(Auth::user()->is_active)
            {
                return redirect()->action('UserController@Dashboard');
            }
            else
            {
                session()->flash('error','Please contact the administator');
                return Redirect::back()->withInput()->withError("Please contact the Administrator");
            }
        }
        else
        {
            session()->flash('error','Invalid Credentials, Please try again later');
            return Redirect::back()->withInput()->withError("Invalid Login Credentials , Please Re-check the data supplied");
        }

    }

    public function Dashboard()
    {
        if(Auth::check())
        {
            $info = info::where(['_to' => 'all'])->orWhere(['_to' => Auth::id()])->orderByDesc('id')->get();
            return view('user.dashboard')->with(['title'=>'Dashboard','news'=>$info]);
        }
        else{
            return \redirect()->action('UserController@SignIn');
        }
    }

    public function Message()
    {
        if(Auth::check())
        {
            $allmsg = messages::where(['reciever_id' => Auth::user()->id])->orderBy('sent_at','desc')->get();
            $messages = messages::where(['read' => false, 'reciever_id' => Auth::user()->id])->orderBy('sent_at','desc')->get();
            return view('user.messages')->with(['title'=> 'Messages','messages'=>$messages, 'allmsg' => $allmsg]);
        }
        else{
            return \redirect()->action('UserController@SignIn');
        }
    }
    public function NewMessage()
    {
        if(Auth::check())
        {
            $users = User::where(['is_active' => true, 'is_admin'=> false])->where('id','<>',Auth::user()->id)->pluck('username','id');
            //echo '<pre>';
            //var_dump($users);
            //echo '</pre>';
            return view('message.new_mesage')->with(['title'=>'Compose Message','users'=>$users]);
        }
        else{
            return \redirect()->action('UserController@SignIn');
        }
    }

    public function SendMessage(Request $request)
    {
        //var_dump($request->rc_id);
        //var_dump($request->textext);

        /*$tmsg = new total_messages();
        $tmsg->identifier = Auth::user()->id . ':' . $request->rc_id;
        $tmsg->t_messages = 1;
        if($tmsg->save())
        {
            $msg = new messages();
            $msg->identifier =
        }*/

        $msg = new messages();
        $msg->sender_id = Auth::user()->id;
        $msg->reciever_id = $request->rc_id;
        $msg->read = false;
        $msg->text = $request->textext;
        $msg->attachment = null;
        if($request->hasFile('attachment'))
        {
            $file = Input::file('attachment');
            $filename = time() . '.' .$file->getClientOriginalExtension();
            $msg->attachment = $filename;
            $request->file('attachment')->move(
                base_path() . '/public/attachment/', $filename
            );
        }
        $msg->from = Auth::user()->id;
        $msg->sent_at = Carbon::now();
        $param = ['rc_id' => $request->rc_id, 'sd_id'=>Auth::user()->id];
        //var_dump($msg);
        if($msg->save())        {
           Session::flash('param', $param); // or rather $result?
            return \redirect()->action('UserController@ShowMessage', ['rc_id' => $msg -> reciever_id]);
        }


    }

    public function OldMessage()
    {

        $rc_id = null;
        $sd_id = null;
        if(Session::has('param')){
            $param = Session::get('param');
            $rc_id = $param['rc_id'];
            $sd_id = $param['sd_id'];
            var_dump($sd_id, $rc_id);
            messages::where(['sender_id' => $sd_id, 'reciever_id'=> Auth::user()->id])->update(array('read'=>true));
            $allmsg = messages::where(['sender_id' => $sd_id, 'reciever_id'=> $rc_id])
                ->orWhere(['sender_id'=>$rc_id, 'reciever_id'=> $sd_id])->get();
            echo '<pre>';
            //var_dump($allmsg);
            echo '</pre>';
            $rc_user = User::find($rc_id);
            return view('message.old_message')->with(['title'=>'Message','messages'=>$allmsg,'rc' => $rc_user]);
        }
        else{
            return \redirect()->action('UserController@Message');
        }

        //
    }

    public function ShowMessage($rc_id)
    {
        if(Auth::check())
        {
            //var_dump($rc_id);
            messages::where(['sender_id' => $rc_id, 'reciever_id'=> Auth::user()->id])->update(array('read'=>true));
            $allmsg = messages::where(['sender_id' => $rc_id, 'reciever_id'=> Auth::user()->id])
                ->orWhere(['sender_id'=>Auth::user()->id, 'reciever_id'=> $rc_id])->get();
            echo '<pre>';
            //var_dump($allmsg);
            echo '</pre>';
            $rc_user = User::find($rc_id);
            return view('message.show')->with(['title'=>'Message','messages'=>$allmsg,'rc' => $rc_user]);
        }
        else{
            Session::flash('error','You have to be Logged in');
            return redirect()->action('UserController@SignIn');
        }
       // }

        //
    }

    public function Downloads($mid)
    {
        $msg = messages::find($mid);
        $file= public_path(). "/attachment/".$msg->attachment;
        return response()->file($file);
    }

    function readReceipt(Request $request){
        //dd($request->all());
        $m = new MemoRead();
        $m->user_id = Auth::id();
        $m->memo_id = $request->memo_id;
        $m->save();
        return redirect()->back();
    }
}
