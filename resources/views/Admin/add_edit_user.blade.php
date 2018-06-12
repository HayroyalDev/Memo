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
                    <h2>{{$title}}</h2>
                    @include('partials._form-message')
                    <div class="col-lg-4">
                        @if(isset($edit))
                            <form class="form-horizontal" method="post" action="{{route('admin.user.action',['type' => 'edit','id' => $user->id])}}">
                                {{csrf_field()}}
                                <input hidden name="id" value="{{$user->id}}">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Email: </label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" value="{{$user->email}}" name="email"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="username">Username </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" value="{{$user->username}}" name="username"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="role">Role: </label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="role" id="role">
                                            <option value="0">Staff/User</option>
                                            <option value="1">Admin</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="status">Status: </label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="status" id="status">
                                            <option value="1">Active</option>
                                            <option value="0">Not Active</option>
                                        </select>
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-block" type="submit">Submit</button>
                            </form>
                        @else
                            <form class="form-horizontal" method="post" action="{{route('admin.user.action',['type' => 'add'])}}">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Email: </label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="username">Username </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" name="username"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="password">Password </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="password" name="password"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="role">Role: </label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="role" id="role">
                                            <option value="0">Staff/User</option>
                                            <option value="1">Admin</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="status">Status: </label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="status" id="status">
                                            <option value="1">Active</option>
                                            <option value="0">Not Active</option>
                                        </select>
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-block" type="submit">Submit</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="NewsModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                    <div class="modal-body">
                        {{Form::open(array('class'=> 'form-horizontal','files'=> true))}}
                        <input type="hidden" id="post_type" name="post_type"/>
                        <input type="hidden" id="sid" name="sid"/>
                        <div class="form-group hide_for_add">
                            <label class="control-label col-sm-2" for="uid">ID: </label>
                            <div class="col-sm-10">
                                <input type="number" name="uid" disabled class="form-control hide_for_add" id="uid"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Title: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="body">Body</label>
                            <div class="col-sm-10">
                                {{Form::textarea('body',null,array('class'=>'form-control','rows'=>'3'))}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="attachment">Attachment(Optional)</label>
                            <br/>
                            <br/><br/><br/>
                            <div class="col-sm-10">
                                {!! Form::file('attachment') !!}
                            </div>
                        </div>
                        <div class="modal-footer student">
                            <button type="submit" class="btn actionBtn" id="edituser">
                                <span id="footer_action_button" class="glyphicon glyphicon-check"></span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> Close
                            </button>
                        </div>
                        {{Form::close()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection