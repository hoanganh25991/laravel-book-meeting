<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>book meeting</title>
</head>
<body>
<ul>navigation
    <li>
        <a href="{{ url('') }}">
            welcome
        </a>
    </li>
    <li>
        <a href="{{ url('home') }}">
            home
        </a>
    </li>
    <li>
        <a href="{{ url('login') }}">
            login
        </a>
    </li>
    <li>
        <a href="{{ url('register') }}">
            register
        </a>
    </li>
    <li>
        <form action="{{ url('logout') }}" method="POST">
            <button>logout</button>
        </form>
    </li>
    <li>
        <a href="{{ url('booking/create') }}">
            booking>create
        </a>
    </li>
    <li>
        <a href="{{ url('booking') }}">
            booking
        </a>
    </li>
    <li>
        <a href="{{ url('group/create') }}">
            group>create
        </a>
    </li>
    <li>
        <a href="{{ url('group/join') }}">
            group>join
        </a>
    </li>
    <li>
        <a href="{{ url('group/verify') }}">
            group>verify
        </a>
    </li>
    <li>
        <a href="{{ url('room') }}">
            room
        </a>
    </li>
    <li>
        <a href="{{ url('room/load') }}">
            room>load
        </a>
    </li>
</ul>
@yield('content')
@yield('script_lib')
</body>
</html>