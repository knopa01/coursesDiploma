@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content">
        <div class="col-md-12">
            <div class="card">
                <div class="position-relative">
                    <div class="card-header ms-4">{{$main_info["course"]->course_name}}
                        <a href="{{route("show_study_form", ["course_id" => $main_info["course"]->id])}}" class="position-absolute top-2 start-0 ms-3" >
                            <img src="/images/back.png" height="20" class="img-back">
                        </a>


                    </div>
                </div>
                <div class="card-body ">
                    <div class="alert ">
                        <div class="alert ">
                            <form method="POST" class="mt-2 col-md-8" action="{{ route('find_student')}}">
                                @csrf
                                <div class="justify-content-center">


                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Имя студента:') }}</label>
                                        <div class="col-md-6 ">
                                            <input type="text" class="form-control loginInputs" id="name" name="name">
                                            <input type="hidden"  id="course_id" name="course_id" value={{$main_info["course"]->id}}>
                                            <button type="submit" class="btn btn-login mt-2">Найти</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="alert card  ">
                            @if(count($groups) != 0)
                                <form method="POST" action="{{route('group_results')}}">
                                    @csrf
                                    <div  id="userGroup">

                                            <div class="row mb-3">
                                                <label for="group_id" class="col-md-4 col-form-label text-md-end">{{ __('Выберите группу:') }}</label>
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
                                                    <button type="submit" class="btn btn-primary btn-login ms-2">Найти</button>
                                                </div>

                                            </div>
                                        <div class="mt-2">
                                            <h3>Группа: {{$main_info["group"]->group_name}}</h3>
                                            @if($msg != "" )
                                                <h3>{{$msg}}</h3>
                                            @else

                                                @if($main_info["students_count"] == 0)
                                                    <h3>Студенты еще не проходят курс.</h3>
                                                @else
                                                    <div class="col-md-10">
                                                        <div class="row mb-3">
                                                            @foreach ($data as $d)
                                                                <div class="col-md-12 mt-2 ">
                                                                @if($d["course"] != null)
                                                                    {{--
                                                                    <input type="hidden" class="form-control" name="name" value="{{ $elem["student"]->name }}">
                                                                    <input type="hidden" class="form-control" name="course_id" value={{$course_id}}>
                                                                    --}}
                                                                    <a href="{{route('find_student', ["name"=>$d["student"]->name, "course_id"=>$main_info["course"]->id])}}" class="text-decoration-none text-white">
                                                                        <div class="alert course-content">
                                                                            <h4>Студент: {{ $d["student"]->name }}</h4>
                                                                            @if($d["course"]->done_date != null)
                                                                                <h5>Курс пройден: {{$d["course"]->done_date}}</h5>
                                                                            @else
                                                                                <h5>Студент проходит курс.</h5>
                                                                            @endif
                                                                        </div>
                                                                    </a>
                                                                @endif
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif

                                        </div>



                                    </div>

                                </form>
                            @else
                                <h3>Список групп пуст.</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
</div>
@endsection
