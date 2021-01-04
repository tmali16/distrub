
@extends('layouts.app')
@section('page')
    {{$page}}
@endsection
@section('content')
<div class="col-md-10">
    <div class="card border-primary">
        <div class="card-header bg-primary text-white "> {{ __('Главная') }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <linechart-component></linechart-component>
                </div>
                <div class="col-6">
                    <barchart-component></barchart-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
