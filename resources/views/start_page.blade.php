<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @viteReactRefresh
    @viteReactRefresh

    @vite(['resources/js/app.js'])

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">

</head>
<body>
<nav class="navbar navbar-expand-md shadow-sm">
    <div class="container">
        @guest
            <a class="navbar-brand text-white" href="{{ url('/') }}">
                <img class="logo" src="{{asset('images/logo.png')}}">
                {{ config('SSUGT Courses', 'SSUGT Courses') }}
            </a>
        @else
            <a class="navbar-brand text-white " href="{{ url('/home') }}">
                <img class="logo" src="{{asset('images/logo.png')}}">
                {{ config('SSUGT Courses', 'SSUGT Courses') }}
            </a>
        @endguest

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="nav-link">Домой</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Войти</a>
                        <a href="{{ route('register_form') }}" class="nav-link">Зарегистрироваться</a>
                        {{--
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        --}}
                    @endauth

                @endif
            </ul>
        </div>

    </div>
</nav>
<div class="container mt-5">
    {{--
    <div class="row">
        <div class="col-12 col-md-6">
            <p class="text-md-left " style="font-size: 1.5rem;">Добро пожаловать на платформу для обучения курсы СГУГиТ!</p>

        </div>
        <div class="col-12 col-md-6">
            <div class='d-flex justify-content-end'>
                <img src="/images/welcome.png"  class=" img-fluid">
            </div>
        </div>
    </div>
    --}}
    <div class="justify-content-center">
        <p class="text-center fw-lighter font-monospace fs-3" >Добро пожаловать на платформу для обучения программированию Курсы СГУГиТ</p>
        <img src="/images/welcome.png"  style="width: 70%; height: 70%; margin-left: 20%" class=" img-fluid">
    </div>


</div>









</body>
</html>
