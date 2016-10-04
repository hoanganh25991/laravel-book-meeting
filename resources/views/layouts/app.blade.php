<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="{{ url('css/docs.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" />
    <!-- Scripts -->
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('login') }}">Login</a></li>
                        <li><a href="{{ url('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container main-content">
        <div class="f_overlay">
            {{--@include('flash::message')--}}
            @if (session()->has('flash_notification.overlay'))
                @include('flash::modal', [
                    'modalClass' => 'flash-modal',
                    'title'      => session('flash_notification.title'),
                    'body'       => session('flash_notification.message')
                ])
            @else
                <div class="alert alert-{{ session('flash_notification.level') }} {{ session()->has('flash_notification.important') ? 'alert-important' : '' }}"
                >
                    @if(session()->has('flash_notification.important'))
                        <button type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-hidden="true"
                        >&times;</button>
                    @endif

                    {!! session('flash_notification.message') !!}
                </div>
            @endif
            <script>
                (function(){
                    let flashMsg = document.querySelector('div.alert');
                    if(!flashMsg){
                        return false;
                    }
                    let flashMsgClass = flashMsg.getAttribute('class');
                    let isImportantMsg = flashMsgClass.includes('alert-important');

                    let waitFor = 3000;
                    let interval = setInterval(function(){
                        if(!isImportantMsg){
                            flashMsg.className += ' animated fadeOutRight';
                        }
                        clearInterval(interval);
                    }, waitFor);
                })();
            </script>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('out-box')
    {{--<example></example>--}}
    {{--<scheduler></scheduler>--}}
    {{--<script src="{{ url('js/app.js') }}"></script>--}}
    {{--<script src="{{ url('js/aui-min.js') }}"></script>--}}
    <script src="{{ url('js/app.js') }}"></script>
    @yield('script_lib')
</body>
</html>
