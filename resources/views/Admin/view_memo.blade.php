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
                <h2>View Memo</h2>
                <div class="row">
                    @include('partials._form-message')
                    <div class="col-lg-6">
                        <p>To: {{$memo->_to}}</p>
                        <p>From: {{$memo->_from}}</p>
                        <p>Subject: {{$memo->subject}}</p>
                        <p>Message: {{$memo->message}}</p>
                        <p>Sent At: {{$memo->created_at}}</p>
                        <hr>
                        <p>Read By:</p>
                        @foreach($memo->read as $item)
                            <p>{{$item->user->username}} : {{$item->created_at}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection