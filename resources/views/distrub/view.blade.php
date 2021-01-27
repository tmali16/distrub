@extends('layouts.app')
@section('page')
    {{$page}}
@endsection
@section('style')
<style>
    .text-small{
        font-size: 0.7rem;
        line-height: 12px;
    }
</style>
@endsection
@section('content')
@php
$whom = ""; 
switch ($distrub->whom) {
    case 'employee':
    $whom = "Сотрудника";
        break;
    case 'boss':
    $whom = "Ответсвенного";
        break;
    default:
    $whom ="Осужденного/Подследственного";
        break;
}  
@endphp
    <div class="col flex flex-row" style="height: 45rem">
        <div class="bg-white w-full" >
            <div class="py-4 px-4 bg-blue-500 text-white ">
                <a class="btn btn-sm text-white " href="{{url()->previous()}}"><i class="fa fa-arrow-alt-circle-left"></i></a> {{ $page }}                 
            </div>
            <div class="px-5 py-4">
                <a href='/distrub/create' class="px-6 py-2 bg-cyan-400 inline-block hover:no-underline  border-white hover:bg-cyan-600 text-white ml-auto"><i class="fa fa-plus-square"></i> Новый</a>
                <div class="grid grid-cols-10">
                    <div class=" col-span-5">
                        <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" class-content="py-2"   content-cols-lg="7" label="Дата и время фиксации">
                            <div class="mt-4 border-0">{{$distrub->dates . " " . $distrub->times }}</div>
                        </b-form-group>
                        <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7"
                            label="Нарушение в отношении">
                            <div class="mt-4 border-0">
                               {{$whom}}
                            </div>
                        </b-form-group>
                        <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7"
                            label="Тип нарушение">
                            <div class="mt-4 border-0">{{$distrub->distrubType->name }}</div>
                        </b-form-group>
                        <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7"
                            label="Учреждение">
                            <div class="mt-4 border-0">{{$distrub->prision->name }}</div>
                        </b-form-group>
                        <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7"
                            label="Оператор" description="{{$distrub->operator->rank->name}}">
                            <div class="mt-4 border-0">{{$distrub->operator->fname . " " . $distrub->operator->name . " " . $distrub->operator->lname }}</div>
                        </b-form-group>
                        <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7"
                            label="Тип и номер видеорегистратора">
                            <div class="mt-4 border-0">{{$distrub->dvr_type == "bwc" ? 'Носимый видеорегистратор' : 'Видеонаблюдение' }}{{', номер: ' . $distrub->dvr_num }}</div>
                        </b-form-group>
                        <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7"
                            label="Номер и дата регистрации">
                            <div class="mt-4 border-0">{{'№'.$distrub->reg_num . " - " . date("d.m.Y",strtotime($distrub->reg_date)) . "г. " }}</div>
                        </b-form-group>
                        <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7"
                            label="Отписан службе">
                            <div class="mt-4 border-0">{{$distrub->service->fullname }}</div>
                        </b-form-group>
                    </div>
                    <div class=" col-span-5">
                        <div class="container-fluid h-100">
                            <b-row>
                                <b-col md="12">
                                    <legend class="text-info">Файлы</legend>
                                </b-col>
                                @foreach ($distrub->media as $item)
                                    <div class="flex flex-row mb-2">
                                        <div class="flex w-20">
                                            <img src="/{{$item->path}}" width="100" height="100" data-toggle="modal" data-target="#imageView" class=" w-full img-thumbnail" alt="">
                                        </div>
                                    </div>
                                @endforeach
                                <b-col md="12" class="">
                                    <hr>
                                    <legend class="text-info">Описание</legend>
                                    <div class="jumbotron p-1 pl-2 mb-0">
                                        <p class="lead mb-0">{{$distrub->descript}}</p>
                                    </div>
                                </b-col>
                            </b-row>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <div class="flex flex-col  bg-white ml-4 " style="width: 45rem">
            <div class="bg-blue-500 px-4 py-4 text-white text-lg">
                Все нарушения
            </div>
            <div class="px-4 py-4 overflow-y-auto">
                @foreach ($distrubs as $item)
                    <div class="flex flex-row bg-gray-100 mb-3 py-2">
                        <div class="flex w-24 h-auto">
                            @if (count($item->media) > 0)
                                <img src="/{{$item->media[0]->path}}" class="w-full" alt="">    
                            @else
                                <div class="px-5 w-24 h-20 py-5 bg-cyan-300"></div>
                            @endif                        
                        </div>
                        <div class="flex flex-col px-3">
                            <a href="{{route("distrub_detail", $item->id)}}" class="text-cyan-500">{{\Str::limit($item->descript, 50, $end='...')}}</a>
                            <span class=" font-bold text-small" style="">{{$distrub->dvr_type == "bwc" ? 'Носимый видеорегистратор' : 'Видеонаблюдение' }}{{', номер: ' . $distrub->dvr_num }}</span>
                            <span class=" font-bold text-small" style=""><span class="text-red-500">В отношении:</span> {{$whom}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal bd-example-modal-lg animate__animated animate__slideInDown" id="imageView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <img src="" class="img-fluid modalViewImage" alt="Responsive image">
            </div>
          </div>
        </div>
    </div>
@endsection
