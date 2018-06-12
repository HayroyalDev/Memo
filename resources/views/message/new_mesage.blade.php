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
                    <h3>Compose New Message</h3>
                    {{Form::open(['files' => true])}}
                    <div class="form-group">
                            <label for="user">Recipient: </label>
                            {{Form::select('rc_id', $users , null,['class' => 'form-control','id'=>'rc_id'])}}
                            <br/>
                        <br/>
                        <br/>
                        <br/>
                        <p><input class="textarea" id='textext' name="textext" type="text" placeholder="Type here!" required/>
                            <br/>
                            Attachment(Optional):   {{Form::file('attachment',['id'=>'attachment', 'class' => 'form-control'])}}
                        </p>
                        <button type="submit" class="btn btn-primary pull-right">Send <span class="glyphicon glyphicon-send"></span></button>
                    </div>


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