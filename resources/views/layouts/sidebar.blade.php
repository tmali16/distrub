@php
$route = \Route::currentRouteName();
@endphp
<div class="list-group list-group-flush">
    <a href="{{route("home")}}" class="list-group-item list-group-item-action @if( $route== "home") active text-white @endif">
        <i class="fa fa-angle-right"></i>
        Главная</a>
    <a href="{{route("distrub_index")}}" class="list-group-item list-group-item-action @if($route == "distrub_index") active text-white @endif"><i class="fa fa-angle-right"></i> Нарушение</a>
    <a href="{{route("empleyee")}}" class="list-group-item list-group-item-action @if($route == "empleyee") active text-white @endif"><i class="fa fa-angle-right"></i> Сотрудники</a>
    <a href="{{route("users")}}" class="list-group-item list-group-item-action @if($route == "users" || $route == "register" || $route == "user_edit") active text-white @endif"><i class="fa fa-angle-right"></i> Пользователи</a>

</div>