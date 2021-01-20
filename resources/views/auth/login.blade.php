@extends('layouts.app')

@section('content')
{{-- id="particles-js" --}}
<div class="h-screen w-screen z-30 absolute" id="particles-js"></div>
<div class="specBg items-center grid grid-cols-3  h-screen " >
    <nav class="absolute z-50 -mr-2 py-4 shadow-lg w-full bg-white" style="z-index: 9999; top-0; position: absolute;">
        <div class="max-w-7xl mx-auto">
            <img class="h-8 w-auto" src="{{asset('images/icon.png')}}" alt="">
        </div>
    </nav>
    <div class="col-span-3 flex justify-center" >
        <div class="border-l-8 z-50 border-cyan-400 bg-white" style="width: 400px;">
            <div class="px-6 py-3">
                <h1 class=" uppercase text-blue-500  text-3xl">Вход в систему</h1>
            </div>
            <form class="px-6 space-y-1" action="#" method="POST">
                @csrf
                <div class="px-4 py-2">
                    <div class="py-3">
                        <label for="username" class="block text-sm font-medium text-gray-500">{{ __('Имя пользователя') }}</label>
                        <input id="username" type="text" class="px-4 py-3 focus:outline-none rounded-sm mt-3 hover:scale-y-150 block w-full font-medium bg-gray-300 text-black-700 @error('username') text-red border border-red-600 @enderror" name="username" value="{{ old('username') }}" required autocomplete="off" autofocus>
                        @error('username')
                            <span class="text-pink-600 text-sm">
                                <strong class="text-red text-sm">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="py-3">
                        <label for="password" class="block text-sm font-medium text-gray-500">{{ __('Пароль') }}</label>
                        <input id="password" type="password" class="px-4 py-3 focus:outline-none rounded-sm mt-3 block w-full font-medium bg-gray-300 text-black-700 @error('password') text-red border border-red-600 @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="text-red text-sm">
                                <strong class="text-red text-sm">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="group my-5 relative w-full flex justify-center py-3 text-lg font-medium text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <!-- Heroicon name: lock-closed -->
                        </span>
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
