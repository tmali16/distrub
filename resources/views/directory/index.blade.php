@extends('layouts.app')
@section('page')
    {{$page}}
@endsection
@section('content')
<div class="col-md-10" style="max-height: 500px;">
    <div class="card border-primary h-100">
        <div class="card-header bg-primary text-white "> {{ $page }}</div>        
        <directory-component ></directory-component>        
    </div>
</div>

@endsection