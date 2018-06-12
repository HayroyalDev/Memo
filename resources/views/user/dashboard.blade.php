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
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    @if(count($news) > 0)
                        @foreach($news as $new)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>{{$new->subject}}</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <p>To: {{$new->_to == 'all' ? 'All' : $new->user->username}}</p>
                                        <p>From: {{$new->_from}}</p>
                                        <p>Message: {{$new->message}}</p>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    Sent at: {{date('F d, Y H:i:s', strtotime($new->created_at))}}<br/>
                                    <br/>
                                    <br/>
                                    <?php $read = \App\MemoRead::where(['memo_id' => $new->id,'user_id' => Auth::id()])->first();?>
                                    @if(!isset($read))
                                        <a href="{{route('memo.read',['memo_id' => $new->id])}}" class="btn btn-success" data-title="Mark As Read" data-tooltip="Mark As Read"><i class="glyphicon glyphicon-check"></i></a>
                                    @else
                                        <p class="alert alert-success">Marked As Read: {{date('F d, Y H:i:s', strtotime($read->created_at))}}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="well">
                            <p>No Information</p>
                        </div>
                    @endif
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
@endsection