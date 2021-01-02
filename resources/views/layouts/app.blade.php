<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @auth
            @include('layouts.nav')
            <div class="container-fluid">
                <div class="col-12 my-5" style="height: 50px;">
                    <div class="row">
                        <div class="col-4">                            
                            <div class="card border-0 bg-transparent text-white">
                                <div class="card-body pr-2 pt-2 pb-0 text-white">
                                    <i class="fa fa-angle-double-left"></i> <label class="card-title h5 ml-3 mb-0"> @yield('page')</label>
                                    <p class="card-text breads">
                                        <a class="" href="{{route("home")}}">Главная</a>
                                        @if (\Route::currentRouteName() != 'home')
                                        <i class="fa fa-angle-right"></i>
                                        <a class="" href="{{route("home")}}">@yield('page')</a>
                                        @endif
                                        
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 ml-auto">
                            <div class="input-group mb-3 border-1">
                                <div class="input-group-prepend bg-primary border-right">
                                    <span class="input-group-text border-1 border-top-0 border-bottom-0 border-left-0 bg-primary" id="basic-addon1"><i class="text-white fas fa-user"></i></span>
                                </div>
                                <label class="form-control text-white bg-primary border-0" aria-label="Username" aria-describedby="basic-addon1">
                                    {{auth()->user()->name}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 justify-content-center">
                    <div class="col-sm-2">
                        <div class="card  border-none">
                            <div class="card-header  border-none">
                                Меню
                            </div>
                            <div class="card-body p-2">
                                @include('layouts.sidebar')
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        @else
            @yield('content')
        @endauth
    </div>
</body>
</html>
