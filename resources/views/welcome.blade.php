@extends('layouts.app')
@section('content')
{{-- <div class="h-screen w-screen z-10 absolute"></div> --}}
<div class="specBg items-center  justify-center grid grid-cols-3  h-screen " >
     <nav class="-mr-2 absolute z-50 w-full">
       {{-- <div class="max-w-7xl mx-auto">
            <img class="h-8 w-auto" src="{{asset('images/icon.png')}}" alt="">
            <ul class="ml-auto">
                <!-- Authentication Links -->
                @guest                   
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>                    
                @endguest
            </ul>
        </div>--}}
        @include('layouts.nav')
    </nav> 
    
    {{-- <div class="z-0 col-span-3  " >
        <main  class="py-4 bg-white " style="">
            <div class="content-center opacity-100" >                    
                <div class="">
                    <div class="rounded-md shadow">
                        <a href="{{route('login')}}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                            Войти
                        </a>
                    </div>
                </div>
            </div>
        </main>        
    </div> --}}
    <div class="col-span-3 mx-4">
        <dvr-component></dvr-component>
    </div>
</div>
@endsection

