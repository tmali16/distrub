@php
    $field['1'] = "operator";
    $field['2'] = "date_time";
    $field['3'] = "descript";
    $field['4'] = "whom";
    $field['5'] = "serviced";
    $field['6'] = "services";
    $field['7'] = "reg_num";
    $field['8'] = "reg_date";
    $field['9'] = "dvr_type";
    $field['10'] = "dvr_num";
    $field['11'] = "distrub_type";
    $field['12'] = "prision";
    $field['13'] = "file";
@endphp
@extends('layouts.app')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('page')
    {{$page}}
@endsection
@section('content')
    <div class="col-md-10">
        <div class="bg-white w-full ">
            <form action="{{route("distrub_store")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-6 gap-3">
                    <div class="col-span-6 px-4 py-4 bg-blue-500 text-white">
                        <h2><a class="btn btn-sm text-white " href="{{url()->previous()}}"><i class="fa fa-arrow-alt-circle-left"></i></a> Новое нарушение</h2>
                    </div>
                    @if (session('status'))
                        <div class="col-span-6">                    
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif                    
                    <div class="col-span-3 px-4 pb-4">
                        <div class="grid">
                            <div class="col-span-6 sm:col-span-3">
                                <fieldset class="w-100 border px-4 pb-4">
                                    <legend class="w-auto text-sm px-2  py-1 bg-blue-500 text-white">Оператор</legend>                                    
                                    <select class="bg-gray-200 px-2 py-1 w-full border border-black outline-none" name="{{$field['1']}}" id="{{$field['1']}}" aria-placeholder="Выберите оператора">                                        
                                        @foreach ($operator as $item)
                                            <option value="{{$item->id}}" @if(old($field['1']) == $item->id) selected @endif>{{$item->fname . " " . $item->name}}</option>    
                                        @endforeach
                                    </select>
                                    @error($field['1'])
                                        <span class="text-red float-left text-sm w-100">
                                            <strong class="text-red text-sm">{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-span-6 sm:col-span-3 mt-4">
                                <fieldset class="w-100 border px-4 pb-4">
                                    <legend class="w-auto text-sm px-2  py-1 bg-blue-500 text-white">Дата и время установления нарушений</legend>                                    
                                    <input type="datetime-local" name="{{$field['2']}}" value="{{old($field['2'])}}" id="{{$field['2']}}" class="@error($field['2']) border border-red-500 @enderror bg-gray-200 px-2 py-1 outline-none w-full border border-black">
                                    @error($field['2'])
                                        <span class="text-red float-left text-sm w-100">
                                            <strong class="text-red text-sm">{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                            </div>
                            
                            <div class="col-span-6 sm:col-span-3 mt-4">
                                <fieldset class="w-100 border px-4 pb-4">
                                    <legend class="w-auto text-sm px-2  py-1 bg-blue-500 text-white">В отношении</legend>
                                    {{-- <label for="{{$field['4']}}" class="block text-sm font-medium text-gray-700">В отношении</label> --}}
                                    <select class="bg-gray-200 px-2 py-1 w-full border border-black outline-none @error($field['4']) border border-red-500 @enderror" name="{{$field['4']}}" id="">
                                        <option value="prison" @if(old($field['4']) == 'prison') selected @endif>Осужденного/Подследственного</option>
                                        <option value="employee" @if(old($field['4']) == 'employee') selected @endif>Сотрудника</option>
                                        <option value="employee" @if(old($field['4']) == 'boss') selected @endif>Ответсвенный</option>
                                    </select>
                                    @error($field['4'])
                                        <span class="text-red float-left text-sm w-100">
                                            <strong class="text-red text-sm">{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-span-6 sm:col-span-3 mt-4">
                                <fieldset class="w-100 border px-4 pb-4">
                                    <legend class="w-auto text-sm px-2  py-1 bg-blue-500 text-white">Отписано</legend>
                                    {{-- <label for="{{$field['6']}}" class="block text-sm font-medium text-gray-700">Отписано</label> --}}
                                    <select class="bg-gray-200 px-2 py-1 w-full border border-black outline-none @error($field['6']) border border-red-500 @enderror" name="{{$field['6']}}" id="">
                                        @foreach ($services as $item)
                                            <option value="{{$item->id}}" @if(old($field['6']) == $item->id) selected @endif>{{$item->shortname}}</option>
                                        @endforeach
                                    </select>
                                    @error($field['6'])
                                        <span class="text-red float-left text-sm w-100">
                                            <strong class="text-red text-sm">{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-span-6 sm:col-span-3 mt-4">
                                <fieldset class="w-100 border px-4 pb-4">
                                    <legend class="w-auto text-sm px-2  py-1 bg-blue-500 text-white">Номер и дата регистрации</legend>
                                    {{-- <label for="{{$field['7']}}" class="block text-sm font-medium text-gray-700"></label> --}}
                                    <span class="px-1 py-1 outline-none w-10 mr-3">№</span>
                                    <input type="text" name="{{$field['7']}}" value="{{old($field['7'])}}" id="{{$field['7']}}" class="@error($field['7']) border border-red-500 @enderror bg-gray-200 px-2 text-sm py-1 outline-none w-20 border border-black">
                                    <span class="px-1 py-1 outline-none w-10 ml-5">Дата</span>
                                    <input type="date" name="{{$field['8']}}" value="{{old($field['8'])}}" id="{{$field['8']}}" class="@error($field['8']) border border-red-500 @enderror bg-gray-200 px-2 text-sm py-1 outline-none w-80 border border-black">
                                    @error($field['7'])
                                        <span class="text-red float-left text-sm w-100">
                                            <strong class="text-red text-sm">{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-span-6 sm:col-span-3 mt-4">
                                <fieldset class="w-100 border px-4 pb-4">
                                    <legend class="w-auto text-sm px-2  py-1 bg-blue-500 text-white">Тип и номер видеорегистратора</legend>
                                    {{-- <label for="{{$field['9']}}" class="block text-sm font-medium text-gray-700">Тип и номер видеорегистратора</label> --}}
                                    <span class="px-1 py-1 outline-none w-10 text-lg mr-3">Тип</span>
                                    <select name="{{$field['9']}}" id="{{$field['9']}}" class="@error($field['9']) border border-red-500 @else border border-black @enderror bg-gray-200 px-2 text-sm py-1  w-60 ">
                                        <option value="bwc">Носимый видеорегистратор</option>
                                        <option value="dvr">Видеонаблюдение</option>
                                    </select>
                                    <span class="px-1 py-1 outline-none w-10 text-lg ml-5">номер</span>
                                    <input type="text" name="{{$field['10']}}" value="{{old($field['10'])}}" id="{{$field['10']}}" class="@error($field['10']) border border-red-500 @else border border-black @enderror bg-gray-200 px-2 text-sm py-1  w-40">
                                    @error($field['9'])
                                        <span class="text-red float-left text-sm">
                                            <strong class="text-red text-sm">{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-span-6 sm:col-span-3 mt-4">
                                <fieldset class="w-100 border px-4 pb-4">
                                    <legend class="w-auto text-sm px-2  py-1 bg-blue-500 text-white">Тип нарушения</legend>
                                    {{-- <label for="{{$field['11']}}" class="block text-sm font-medium text-gray-700">Тип нарушения</label> --}}
                                    <select class="bg-gray-200 px-2 py-1 w-full border border-black outline-none @error($field['11']) border border-red-500 @enderror" name="{{$field['11']}}" id="{{$field['11']}}">
                                        @foreach ($DistrubTypes as $item)
                                            <option value="{{$item->id}}" @if(old($field['11']) == $item->id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error($field['11'])
                                        <span class="text-red float-left text-sm">
                                            <strong class="text-red text-sm">{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-span-6 sm:col-span-3 mt-4">
                                <fieldset class="w-100 border px-4 pb-4">
                                    <legend class="w-auto text-sm px-2  py-1 bg-blue-500 text-white">Учреждение</legend>
                                    {{-- <label for="{{$field['12']}}" class="block text-sm font-medium text-gray-700">Учреждение</label> --}}
                                    <select class="bg-gray-200 px-2 py-1 w-full border border-black outline-none @error($field['12']) border border-red-500 @enderror" name="{{$field['12']}}" id="{{$field['12']}}">
                                        @foreach ($prisions as $item)
                                            <option value="{{$item->id}}" @if(old($field['12']) == $item->id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error($field['12'])
                                        <span class="text-red float-left text-sm">
                                            <strong class="text-red text-sm">{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-3 px-4">
                        <div class="grid grid-cols-6">
                            <div class="col-span-6 ">
                                <fieldset class="w-100 border px-4 pb-4">
                                    <legend class="w-auto text-sm px-2 bg-blue-500 text-white">Описание нарушения</legend>
                                    {{-- <label for="{{$field['3']}}" class="block text-sm font-medium text-gray-700">Описание нарушения</label> --}}
                                    <textarea name="{{$field['3']}}" rows="6" id="{{$field['3']}}" class="bg-gray-200 px-2 py-1 outline-none w-full border border-black @error($field['3']) border border-red-500 @enderror">
                                        {{old($field['3'])}}
                                    </textarea>
                                    @error($field['3'])
                                        <span class="text-red float-left text-sm">
                                            <strong class="text-red text-sm">{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-span-6  mt-4">
                                <fieldset class="w-100 border px-4 pb-4">
                                    <legend class="w-auto text-sm px-2 py-1 bg-blue-500 text-white"> <i class="fa fa-paperclip text-ted-500"></i> Фото и видео файлы</legend>
                                    <input type="file" name="{{$field['13']}}[]" multiple id="{{$field['13']}}">                                    
                                    @error($field['13'])
                                        <span class="text-red float-left text-sm">
                                            <strong class="text-red text-sm">{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-span-6 mt-4 px-4">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="col-span-6 px-4 py-2 bg-gray-50 mt-4 flex justify-end gap-3">
                                <button type="submit" class="px-4 py-2 w-40 bg-blue-500 text-white">Сохранить</button>
                                <button type="reset" class="px-4 py-2 w-40 bg-blue-400 text-white">Очистить</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')

<script>

</script>
@endsection