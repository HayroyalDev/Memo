<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> {{$title}}: Memo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="_token" content="{!! csrf_token() !!}" />
    <link href="{{ asset('css/paper.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
    @yield('stylesheet')
</head>
<body>
<div class="">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            @include('partials._message')
            <div class="panel panel-primary formm">
                <div class="panel-heading">
                    <p class="header">Sign In</p>
                </div>
                <div class="panel-body">
                    {{Form::open(['class'=>'col s12'])}}
                        <div class="form-group">
                            <label for="username">Username</label>
                            {{Form::text("username","",array("required" => "true","id"=>"email","class"=>"form-control formitem","required"=>true,"placeholder"=>"Username"))}}
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            {{Form::password("password",array("required"=>"true" ,"id"=>"password","class"=>"form-control formitem","required"=>true,"placeholder"=>"Password"))}}
                        </div>
                        <div class="form-group">
                            <p>
                                <input type="checkbox" id="remember">
                                <label for="remember">Remember me</label>
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="right-align">
                                <button class="btn btn-primary btn-block formitem" type="submit" name="action">Login</button>
                            </p>
                        </div>
                    {{Form::close()}}
                </div>

            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>
@include('partials._footer')

</body>
<script type="text/javascript" src="{{asset('js/jquery-1.10.2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
</html>
