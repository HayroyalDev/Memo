<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> {{$title}}: Memo </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="_token" content="{!! csrf_token() !!}" />
    <base href="{{asset('/')}}"/>
    <link href="css/paper.css" rel="stylesheet"/>
    <link href="css/custom.css" rel="stylesheet"/>
    @yield('stylesheet')
</head>
