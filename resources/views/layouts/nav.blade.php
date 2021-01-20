<nav class="navbar navbar-expand-md navbar-light bg-white shadow-lg">
    <div class="container">
        <a class="text-red-500 hover:no-underline hover:text-red-600 py-3 text-3xl font-bold" href="{{ url('/') }}">
            <img src="{{asset('images/icon.png')}}" alt="icon" class="inline-block w-10 px-2">{{ config('app.name', 'DisFix') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                    </li>                    
                @else
                    <li class="nav-item dropdown">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="form-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger"><i class="fa fa-power-off"></i></button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
