
@extends('layouts.app')
@section('page')
    {{$page}}
@endsection
@section('content')
<div class="col-md-10">
    <div class="card border-primary">
        <div class="card-header bg-primary text-white "> {{ __('Главная') }}</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <linechart-component></linechart-component>
        </div>
    </div>
</div>
@endsection
