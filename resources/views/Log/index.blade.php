@extends('layouts.app')

@section('content')

<journal-component :auth="{{($user)}}"></journal-component>
@endsection