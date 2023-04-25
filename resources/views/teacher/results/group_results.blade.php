@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content">
        <h2>{{$main_info["course"]->course_name}}</h2>
        <div class="row mb-3 " >
        <form method="POST" class="mt-2 col-md-8" action="{{ route('find_student')}}">
            @csrf



                    <h4>Имя студента:</h4>
                    <div class="form-group ">

                        <input type="text" class="form-control loginInputs" id="name" name="name">
                        <input type="hidden" class="form-control" id="course_id" name="course_id" value={{$main_info["course"]->id}}>
                        <button type="submit" class="btn btn-login btn-block mt-2">Найти</button>
                    </div>

        </form>

        </div>
        @if(count($groups) != 0)
            <form method="POST" action="{{route('group_results')}}">
                @csrf
                <div  id="userGroup">
                    <label for="group_id" class=" col-form-label text-md-end">{{ __('Выберите группу:') }}</label>
                    <div class="col-md-6">
                        <select id="group_id" name="group_id" class="select-style @error('group_id') is-invalid @enderror" >
                            <option selected>Выберите значение</option>
                            @foreach($groups as $group)
                                <option value="{{$group->id}}">{{$group->group_name}}</option>
                            @endforeach
                        </select>
                        @error('group_id')

                        <span class="invalid-feedback" role="alert">
                            {{--<div class="text-danger" style="font-size: .875em;"> <strong>Выберете группу!</strong> </div>--}}
                                <strong>{{$message}}</strong>
                        </span>
                        @enderror
                        <input type="hidden" class="form-control" id="course_id" name="course_id" value={{$main_info["course"]->id}}>
                        <button type="submit" class="btn btn-primary btn-block ms-2">Найти</button>
                    </div>

                </div>

            </form>
        @else
            <h3>Список групп пуст.</h3>
        @endif
        <div class="mt-2">
            <h2>Группа: {{$main_info["group"]->group_name}}</h2>
            @if($msg != "" )
                <h3>{{$msg}}</h3>
            @else

                @if($main_info["students_count"] == 0)
                    <h3>Студенты еще не проходят курс.</h3>
                @else
                    <div class="col-md-8">
                        <div class="row mb-3">
                            @foreach ($data as $d)

                                @if($d["course"] != null)
                                {{--
                                <input type="hidden" class="form-control" name="name" value="{{ $elem["student"]->name }}">
                                <input type="hidden" class="form-control" name="course_id" value={{$course_id}}>
                                --}}
                                    <a href="{{route('find_student', ["name"=>$d["student"]->name, "course_id"=>$main_info["course"]->id])}}" class="text-decoration-none">
                                        <div class="alert loginInputs">
                                            <h3>Студент: {{ $d["student"]->name }}</h3>
                                            @if($d["course"]->done_date != null)
                                                <h4>Курс пройден: {{$d["course"]->done_date}}</h4>
                                            @else
                                                <h4>Студент проходит курс.</h4>
                                            @endif
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
            <a href="{{route("show_study_form", ["course_id" => $main_info["course"]->id])}}" class="btn btn-back">Назад</a>
        </div>

    </div>
</div>
@endsection
