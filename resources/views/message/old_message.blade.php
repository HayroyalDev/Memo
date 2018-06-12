@extends('master')
@section('content')
    <div class="row">
        @include('partials._navbar')
    </div>
    <div class="row">
        <div class="col-lg-3">
            @include('partials._sidebar')
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-10">
                    <h3>{{$rc->username}}</h3>
                    <ol class="chat">
                        @foreach($messages as $msg)
                            @if($msg->sender_id == \Illuminate\Support\Facades\Auth::user()->id)
                                <li class="self">
                                    <div class="avatar"><img src="{{asset('images/default.png')}}" draggable="false"/></div>
                                    <div class="msg">
                                        <p>{{$msg->text}}</p>
                                        <time>20:18</time>
                                    </div>
                                </li>
                            @else
                                <li class="other">
                                    <div class="avatar"><img src="{{asset('images/default.png')}}" draggable="false"/></div>
                                    <div class="msg">
                                        <p>{{$msg->text}}</p>
                                        <time>20:17</time>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                    {{Form::open()}}
                    <input type="hidden" id="rc_id" name="rc_id" value="{{$rc->id}}"/>
                    <p><input class="textarea" type="text" placeholder="Type here!" id="textext" name="textext"/>
                        <br/>
                    </p>
                    <button type="submit" class="btn btn-primary pull-right">Send <span class="glyphicon glyphicon-send"></span></button>

                    {{Form::close()}}
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>

    <br/>
    <br/>
    <br/>
@endsection