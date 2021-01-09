@extends('layouts.app')
@section('content')
<div class="h-screen w-screen z-10 absolute" id="particles-js"></div>
<div class="items-center  justify-center grid grid-cols-3  h-screen " >
    <nav class="absolute z-50 -mr-2 py-4 shadow-lg w-full bg-white" style="z-index: 9999; top-0; position: absolute;">
        <div class="max-w-7xl mx-auto">
            <img class="h-8 w-auto" src="{{asset('images/icon.png')}}" alt="">
        </div>
    </nav>
    <div class="specBg shadow-xl flex items-center h-screen px-14" >
        <main  class="py-4 z-50 absolute rounded-xl shadow-xl bg-white " style="width: 750px">
            <div class="content-center opacity-100 px-5" >
                    <h1 class="text-4xl tracking-tight font-extrabold w-full text-white sm:text-5xl md:text-6xl">
                        <span class="block xl:inline text-red-700 uppercase">Добро пожаловать</span>
                        <span class="block text-blue-500 ">портал статистики</span>
                    </h1>
                    <p class="mt-3 text-base text-black ">
                        Информационный портал для фиксации и сбора статистики нарушений
                    </p>
                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                    <div class="rounded-md shadow">
                        <a href="{{route('login')}}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                            Войти
                        </a>
                    </div>
                </div>
            </div>
        </main>
        {{-- <div class="text-white absolute z-10 h-screen" >
            <svg class="absolute h-screen w-40" fill="" viewBox="70 100 0 0" preserveAspectRatio="none" aria-hidden="true">
                <polygon class="shadow-lg" points="70,0 0,0 0,0 0,0" />
            </svg>
        </div> --}}
    </div>
    <div class="col-start-2 col-span-2 h-screen">
        {{-- <div class="specBg absolute z-10 h-screen" >
            <svg class="absolute h-screen w-40" fill="" viewBox="0 0 70 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon class="shadow-lg" points="0,0 0,0 70,0 0,100" />
            </svg>
        </div> --}}
        <!-- Slider main container -->
        <div class="swiper-container h-full w-full">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper h-screen">
                <!-- Slides -->
                <div class="swiper-slide h-full" ><img class="bg-contain" src="{{asset('images/slider01.jpg')}}" alt=""></div>
                <div class="swiper-slide h-full" ><img class=" bg-contain" src="{{asset('images/slider02.jpg')}}" alt=""></div>
            </div>
        </div>
    </div>
</div>
@endsection

