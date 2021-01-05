@extends('layouts.app')

@section('content')
{{-- <div class="container h-100">
    <div class="row h-100 justify-content-center">
        <div class="col-md-6 my-auto">
            <div class="shadow  bg-white">
                <div class="py-3 bg-blue-400 px-3 text-white font-normal text-lg">{{ __("Вход") }}</div>
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class=" overflow-hidden sm:rounded-md">

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="username" class="block text-sm font-medium text-gray-700">{{ __('Имя пользователя') }}</label>
                                            <input id="username" type="text" class="px-4 py-2 block font-medium border border-gray-500 focus:border-gray-500 text-black-700 @error('username') text-red border border-red-600 @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Пароль') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Вход') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class=" min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <transition
            enter-active-class="transition ease-out duration-200 transform"
            enter-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition ease-in duration-100 transform"
            leave-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
            >
            <div class=" transition-all border-l-8 hover:border-l-8 border-blue-500 hover:shadow-lg bg-white">
                {{-- <div class="bg-blue-900 px-4 py-4 text-lg text-white font-medium">
                    <h2>{{ __('Вход') }}</h2>
                </div> --}}
                <div class="px-6 py-3 ">
                    {{-- <i class=" text-red-300 fa fa-user-lock text-7xl"></i> --}}
                <h1 class=" uppercase text-blue-500  text-3xl">Вход в систему</h1>
                </div>
                <form class="px-6 space-y-1" action="#" method="POST">
                    @csrf
                    <div class="px-4 py-2">
                        <div class="py-3">
                            <label for="username" class="block text-sm font-medium text-gray-500">{{ __('Имя пользователя') }}</label>
                            <input id="username" type="text" class="px-4 py-3 focus:outline-none rounded-sm mt-3 hover:scale-y-150 block w-full font-medium bg-gray-300 text-black-700 @error('username') text-red border border-red-600 @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
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
        </transition>
    </div>
</div>
@endsection
