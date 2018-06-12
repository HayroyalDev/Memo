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
                    <h4>{{$title}}</h4>
                    @include('partials._form-message')
                    @include('partials._message')
                    <div class="col-lg-5">
                        <form method="post" action="{{route('memo.add')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>To:</label>
                                <select name="to" class="form-control">
                                    <option value="all">All</option>
                                    @foreach($user as $u)
                                        <option value="{{$u->id}}">{{$u->username}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>From:</label>
                                <input class="form-control" required name="from" placeholder="From"/>
                            </div>
                            <div class="form-group">
                                <label>Subject:</label>
                                <input class="form-control" required name="subject" placeholder="Subject"/>
                            </div>
                            <div class="form-group">
                                <label>Message:</label>
                                <textarea class="form-control" required name="message" rows="3" placeholder="Message"></textarea>
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">Add Memo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection