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
                    <h3>Messages</h3>
                    <br/>
                    <br/>
                    <br/>
                    <a href="{{route('message.new')}}" class="btn btn-lg btn-primary btn-block pull-right">Compose New Message <span class="glyphicon glyphicon-envelope"></span></a>


                    <br/><br/><br/>

                    <h3>Unread Messages</h3>
                    @if(count($messages) > 0)
                        @foreach($messages as $msg)
                            <?php $user = \App\User::find($msg->sender_id);?>
                            <a href="{{url('dashboard/messages/'. $msg->sender_id)}}">
                                <div class="panel panel-default">
                                <div class="panel-heading">
                                    <p> <h5>Message Content: {{$msg->text}}  </h5></p>
                                </div>
                                <div class="panel-body">
                                    Sent By: {{$user->username}} <br/>
                                    Sent At: {{date('F d, Y H:i:s', strtotime($msg->sent_at))}}
                                </div>
                            </div>
                            </a>
                        @endforeach
                    @else
                        <div class="well-lg">
                            <p>No Unread Messages</p>
                        </div>
                    @endif
                        <br/> <br/> <br/>
                    <h3>All Messages</h3>
                    @if(count($allmsg) > 0)
                        @foreach($allmsg as $msg)
                            <?php $user = \App\User::find($msg->sender_id)?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <p> <h5>Message Content: {{$msg->text}}  </h5></p>
                                </div>
                                <div class="panel-body">
                                    Sent By: {{$user->username}} <br/>
                                    Sent At: {{date('F d, Y H:i:s', strtotime($msg->sent_at))}}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="well-lg">
                            <p>No Messages</p>
                        </div>
                    @endif
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>

    <br/>
    <br/>
    <br/>
@endsection