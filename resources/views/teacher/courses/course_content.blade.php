@extends('layouts.app')
@section('content')
<div class="container ">
    <h4>Данные курса:</h4>
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('edit_course') }}">
            @csrf
            <div class="alert alert-info">
                <div class="row mb-3">
                    <label for="course_name" class="col-md-4 col-form-label text-md-end">Название курса:</label>
                    <div class="col-md-6">
                        <input id="course_name" type="text" class="form-control" name="course_name" value="{{$course->course_name}}">
                        <input id="course_id" type="hidden" class="form-control" name="course_id" value={{$course->id}}>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="language_id" class="col-md-4 col-form-label text-md-end">Язык:</label>
                    <div class="col-md-6">
                        <select id="language_id" name="language_id" class="@error('language_id') is-invalid @enderror">
                            <option selected value={{$selected_language->id}}>{{$selected_language->language_name}}</option>
                            @foreach ($languages as $language)
                                <option value={{$language->id}}>{{$language->language_name}}</option>

                            @endforeach
                        </select>
                        @error('language_id')
                                <div class="alert alert-danger"> Пожалуйста, выберите язык</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="course_description" class="col-md-4 col-form-label text-md-end">Описание курса</label>
                    <div class="col-md-6">
                        <input id="course_description" type="text" class="form-control" name="course_description" value={{$course->course_description}}>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <a href="{{ route('delete_course', ['course_id'=>$course->id]) }}" class="btn btn-danger mb-2">Удалить курс</a>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Сохранить
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        @if ($data)
        <h4>Содержание:</h4>
        @foreach ($data as $elem)
            <div class="row mb-0">
                <div class="alert alert-info">
                    <a href="{{ route('manage_content', ['course_id'=>$course_id, 'content_id'=>$elem->id]) }}" >
                        <h3>{{ $elem->content_name }}</h3>

                    </a>
                </div>

            </div>
        @endforeach
        @endif
    </div>
    <div class="btn">
        <a href="{{ route('create_content', ['course_id'=>$course_id]) }}" class="btn btn-primary">Создать лекцию/задачу</a>

    </div>

</div>

@endsection
