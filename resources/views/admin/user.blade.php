@extends('layouts.app')
@section('page')
    {{$page}}
@endsection
@section('content')
    <div class="col-md-10">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white ">{{$page ?? ""}}</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="overflow-hidden mb-3">
                    <div class="px-0 py-3 bg-white sm:p-6">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="col-span-6 sm:col-span-3">
                                <a href="/register" class="no-underline hover:no-underline  px-4 py-3  text-white bg-blue-500 hover:bg-blue-700"> <i class=" no-underline fa fa-user"></i> Новый пользователь</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow">
                                <table class="min-w-full divide-y divide-black-900 ">
                                    <thead class="bg-gray-50 ">
                                        <tr class="bg-blue-400 text-white">
                                            <th scope="col" class="px-6 py-3 text-left font-medium text-white-500 uppercase tracking-wider">#</th>
                                            <th scope="col" class="px-6 py-3 text-left font-medium text-white-500 uppercase tracking-wider">Имя пользователя</th>
                                            <th scope="col" class="px-6 py-3 text-left font-medium text-white-500 uppercase tracking-wider">Имя</th>
                                            <th scope="col" class="px-6 py-3 text-left font-medium text-white-500 uppercase tracking-wider">Дата создания</th>
                                            <th scope="col" class="px-6 py-3 text-left font-medium text-white-500 uppercase tracking-wider">Управление</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key=>$item)
                                            <tr class="bg-white border-bottom border-gray-600  hover:shadow-lg mb-3 mt-3 cursor-pointer hover:border-4 hover:border-gray-800">
                                                <th scope="row" class="px-6 py-3">{{$key+1}}</th>
                                                <td class="px-6 py-3">{{$item->username}}</td>
                                                <td class="px-6 py-3">{{$item->name}}</td>
                                                <td class="px-6 py-3">{{$item->created_at}}</td>
                                                <td class="px-6 py-3">
                                                    <a href="{{route("user_edit", ['id'=>$item->id])}}" class="btn btn-sm btn-outline-success mx-2"><i class="fa fa-pencil-alt"></i> </a>
                                                    <a href="#" class="btn btn-sm btn-outline-info mx-2" id="newUserPassBtn" data-toggle="modal" data-target="#passModal" data-pass="{{$item->id}}"><i class="fa fa-key"></i> </a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger mx-2" id="deleteUserDataBtn" data-toggle="modal" data-target="#deleteModal" data-value="{{$item->id}}"><i class="fa fa-trash"></i> </a>
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal animate__animated animate__fadeIn animate__faster" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered bd-example-modal-sm" role="document">
        <form method="POST" action="{{route("user_delete")}}" >
            @csrf
            <div class="modal-content">
                <div class="modal-header p-3">
                    <h6 class="modal-title" id="exampleModalLabel">Удаление</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-2">
                    <h4>Вы действительно хотите удалить?</h4>
                    <input type="hidden" name="id" id="deleteUserId">
                    <div class="float-right mt-5">
                        <button type="button" class="btn btn-sm btn-secondary " data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-sm btn-danger ">Удалить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal animate__animated animate__fadeIn animate__faster" id="passModal" tabindex="-1" role="dialog" aria-labelledby="passModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered bd-example-modal-md" role="document">
        <form method="POST" action="{{route("user_pass_edit")}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header p-3">
                    <h6 class="modal-title" id="exampleModalLabel">Новый пароль</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-2">
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Повторите пароль') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <input type="hidden" name="id" id="UserPassId">
                    <div class="float-right mt-5">
                        <button type="button" class="btn btn-sm btn-secondary " data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-sm btn-success ">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

