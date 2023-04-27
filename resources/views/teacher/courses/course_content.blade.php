@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="position-relative">
                    <div class="card-header ms-4">{{ __('Данные курса') }}
                        <a href="{{route("home")}}" class="position-absolute top-2 start-0 ms-3" >
                            <img src="/images/back.png" height="20" class="img-back">
                        </a>


                    </div>
                </div>

                    <div class="card-body ">
                        <form method="POST" action="{{ route('edit_course') }}">
                            @csrf
                            <div class="alert ">
                                <div class="row mb-3">
                                    <label for="course_name" class="col-md-4 col-form-label text-md-end">Название курса:</label>
                                    <div class="col-md-6 ">
                                        <input  id="course_name" type="text" class=" loginInputs form-control @error('course_name') is-invalid @enderror" name="course_name" value="{{$course->course_name}}">
                                        @error("course_name")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                        <input  id="course_id" type="hidden" class=" loginInputs form-control" name="course_id" value={{$course->id}}>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="language_id" class="col-md-4 col-form-label text-md-end">Язык:</label>
                                    <div class="col-md-6">
                                        <select id="language_id" name="language_id" class="select-style @error('language_id') is-invalid @enderror">
                                            <option selected value={{$selected_language->id}}>{{$selected_language->language_name}}</option>
                                            @foreach ($languages as $language)
                                                <option value={{$language->id}}>{{$language->language_name}}</option>

                                            @endforeach
                                        </select>
                                        @error('language_id')

                                                <span class="invalid-feedback" role="alert">
                                                    <strong>Пожалуйста, выберите язык!</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="course_description" class="col-md-4 col-form-label text-md-end">Описание курса</label>
                                    <div class="col-md-6">
                                        <input id="course_description " type="text" class="loginInputs form-control @error('course_description') is-invalid @enderror" name="course_description" value="{{$course->course_description}}">
                                        @error('course_description')

                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-save">
                                            Сохранить
                                        </button>
                                        <a href="{{ route('delete_course', ['course_id'=>$course->id]) }}" class="btn btn-cancel ms-1">Удалить курс</a>

                                    </div>
                                </div>

                            </div>
                        </form>
                        <div class="alert card  ">
                        @if ($data)

                            <h4>Содержание:</h4>
                            <div class="">
                            @foreach ($data as $elem)
                                <div class="col-md-12 mt-2 ">
                                    <a href="{{ route('manage_content', ['course_id'=>$course_id, 'content_id'=>$elem->id]) }}" class="text-decoration-none text-white" >
                                    <div class="alert course-content">

                                            <h3>Название: {{ $elem->content_name }}</h3>
                                            @if ($elem->type_of_content == "lecture")
                                                <h4>Тип: Теория</h4>
                                            @else
                                                <h4>Тип: Задача</h4>
                                            @endif



                                    </div>
                                    </a>

                                </div>
                            @endforeach
                            </div>
                        @endif
                            <div class="col-md-8 ">
                                <a href="{{ route('create_content', ['course_id'=>$course_id]) }}" class="btn btn-login" style="width:200px;">Создать лекцию/задачу</a>
                            </div>
                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>



</div>

@endsection
