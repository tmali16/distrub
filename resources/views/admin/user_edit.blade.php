@extends('layouts.app')
@section('page')
    {{$page}}
@endsection
@section('content')
<div class="col-md-10">
    <div class="card">
        <div class="card-header">{{ __('Новый пользователь') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('user_edit_store', ['id'=>$user->id]) }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Имя пользователя') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username}}" required>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Роль') }}</label>
                    <div class="col-md-6">
                        <select name="role" id="role" class="form-control">
                            <option value="null">---Выберите---</option>
                            @foreach ($roles as $item)
                            <option value="{{$item->id}}" @if($user->hasOneRole($item->id)) selected @endif>{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('roles')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" disabled value="{{$user->password}}" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Сохранить') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
