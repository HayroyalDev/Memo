@extends('master')
@section('content')
    <div class="row">
        @include('partials._adminNavbar')
    </div>
    <div class="row">
        <div class="col-lg-3">
            @include('partials._adminSideBar')
        </div>
        <div class="col-lg-9">
            <div class="container">
                <div class="row">
                    @include('partials._message')
                    @include('partials._form-message')
                    <div class="container">
                        <div class="col-lg-12">
                            <table class="table">
                                <thead>
                                <th>S/N</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Active</th>
                                <th>Added</th>
                                <th>Added By</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->username}}</td>
                                        @if($user->is_admin)
                                            <td>Admin</td>
                                        @else
                                            <td>Staff/User</td>
                                        @endif
                                        @if($user->is_active)
                                            <td>Active</td>
                                        @else
                                            <td>Not Active</td>
                                        @endif
                                        <td>{{date('F d, Y H:i:s', strtotime($user->created_at))}}</td>
                                        <td>Prime</td>
                                        <td>
                                            <a href="{{route('admin.user.action',['type' =>'edit','id' => $user->id])}}" class="btn btn-primary btnmargin edit-user-modal" data-id="{{$user->id}}" data-email="{{$user->email}}" data-username="{{$user->username}}" data-is_admin="{{$user->is_admin}}" data-is_active="{{$user->is_active}}"><span class="glyphicon glyphicon-edit"></span> &nbsp; Edit </a>
                                            <a href="{{route('admin.user.action',['type' =>'delete','id' => $user->id])}}" class="btn btn-danger btnmargin"><span class="glyphicon glyphicon-trash"></span> &nbsp;Delete </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection