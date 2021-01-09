@extends('layouts.app')
@section('page')
    {{$page}}
@endsection
@section('content')
<div class="container">
    <div class="col-sm-5">
        <video src="/storage/{{$g}}"></video>
    </div>
</div>
@endsection