@extends('layouts.app')
@section('page')
    {{$page}}
@endsection
@section('content')
    <div class="col-md-10">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white ">
                <a class="btn btn-sm text-white " href="{{url()->previous()}}"><i class="fa fa-arrow-alt-circle-left"></i></a> {{ $page }}
            </div>
            <div class="card-body">
                <div class="row h-100">
                <b-col cols='6' class="h-100">
                    <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7" label="Дата и время фиксации">
                        <span class=" border-0">{{$distrub->dates . " " . $distrub->times }}</span>
                    </b-form-group>
                    <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7"
                        label="Нарушение в отношении">
                        <span class=" border-0">{{$distrub->whom == "employee" ? "Сотрудника" : "Осужденного/Подследственного" }}</span>
                    </b-form-group>
                    <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7"
                        label="Тип нарушение">
                        <span class=" border-0">{{$distrub->distrubType->name }}</span>
                    </b-form-group>
                    <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7"
                        label="Учреждение">
                        <span class=" border-0">{{$distrub->prision->name }}</span>
                    </b-form-group>
                    <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7"
                        label="Оператор" description="{{$distrub->operator->rank->name}}">
                        <span class=" border-0">{{$distrub->operator->fname . " " . $distrub->operator->name . " " . $distrub->operator->lname }}</span>
                    </b-form-group>
                    <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7"
                        label="Тип и номер видеорегистратора">
                        <span class=" border-0">{{$distrub->dvr_type == "bwc" ? 'Носимый видеорегистратор' : 'Видеонаблюдение' }}{{', номер: ' . $distrub->dvr_num }}</span>
                    </b-form-group>
                    <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7"
                        label="Номер и дата регистрации">
                        <span class=" border-0">{{'№'.$distrub->reg_num . " - " . date("d.m.Y",strtotime($distrub->reg_date)) . "г. " }}</span>
                    </b-form-group>
                    <b-form-group id="fieldset-horizontal" label-cols-sm="5" label-cols-lg="4" content-cols-sm content-cols-lg="7"
                        label="Отписан службе">
                        <span class=" border-0">{{$distrub->service->fullname }}</span>
                    </b-form-group>
                </b-col>
                <b-col cols="6" class="h-100" style="height: 500px">
                    <div class="container-fluid h-100">
                        <b-row>
                            <b-col md="12">
                                <legend class="text-info">Файлы</legend>
                            </b-col>
                            @foreach ($distrub->media as $item)
                                <b-col cols="2">
                                    <img src="/{{$item->path}}" width="100" height="100" data-toggle="modal" data-target="#imageView" class="img-thumbnail" alt="">
                                </b-col>
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
                </b-col>
                </div>
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
