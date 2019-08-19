<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Feedle') }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Feedle') }}
            </a>
            <div class="navbar-nav">
                <a href="{{ route('login') }}" class="navbar-link">Log In</a>
                <a href="{{ route('register') }}" class="navbar-link">Register</a>
            </div>
        </div>
    </nav>

    @yield('content')
</body>
</html>
