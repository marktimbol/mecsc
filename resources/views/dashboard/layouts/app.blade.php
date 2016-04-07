<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf_token" content="{{ csrf_token() }}" />
        
        <title>MECSC.org</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
        <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

        @yield('header_styles')
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
        
            @include('dashboard.layouts._topNav')

            @include('dashboard.layouts._sidebar')
            
            <div class="content-wrapper">

                @yield('content')

                @include('dashboard.layouts._sidebar-right')   

            </div>

        </div>

        <script src="{{ elixir('js/app.js') }}"></script>

@include('layouts._footer')
