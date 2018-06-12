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
                   @include('partials._form-message')
                   <div class="col-lg-10">
                       @if(count($memo) > 0)
                           <table class="table table-responsive">
                               <thead>
                                    <th>S/N</th>
                                    <th>To</th>
                                    <th>From</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Created_at</th>
                                    <th>Actions</th>
                               </thead>
                               <tbody>
                                    <?php $k =1?>
                                    @foreach($memo as $i)
                                        <tr>
                                            <td>{{$k++}}</td>
                                            <td>{{$i->_to == 'all' ? 'All' : $i->user->username}}</td>
                                            <td>{{$i->_from}}</td>
                                            <td>{{$i->subject}}</td>
                                            <td>{{$i->message}}</td>
                                            <td>{{$i->created_at}}</td>
                                            <td>
                                                <div class="form-inline">
                                                    <p>
                                                        <a href="{{route('memo.view',['id' => $i->id])}}" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                        <a href="{{route('memo.delete',['id' => $i->id])}}" onclick="return confirm('Are you sure you want to delete memo?')" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                               </tbody>
                           </table>
                       @else
                           <div class="well center-block">
                               <p>No Memorandum</p>
                           </div>
                       @endif
                   </div>
               </div>
           </div>
        </div>
    </div>
@endsection