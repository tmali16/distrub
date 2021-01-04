@extends('layouts.app')
@section('page')
    {{$page}}
@endsection
@section('content')
<div class="col-md-10">
    <div class="card border-primary">
        <div class="card-header bg-primary text-white "> {{ $page }}</div>        
        <directory-component ></directory-component>        
    </div>
</div>

@endsection