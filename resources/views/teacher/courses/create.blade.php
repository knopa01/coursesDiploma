@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Создать курс') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('created_course') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="course_name" class="col-md-4 col-form-label text-md-end">Название курса</label>

                            <div class="col-md-6">
                                <input id="course_name" type="text" class="form-control @error('course_name') is-invalid @enderror" name="course_name" value="" >
                                @error('course_name')
                                    <div class="alert alert-danger"> Необходимо заполнить это поле!</div>
                                @enderror

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="language_id" class="col-md-4 col-form-label text-md-end">{{ __('Выберете язык') }}</label>
                            <div class="col-md-6">

                                <select id="language_id" name="language_id" class="@error('language_id') is-invalid @enderror">

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
                                <textarea rows="4", cols="54" id="course_description" class="form-control @error('course_description') is-invalid @enderror" name="course_description"></textarea>
                            </div>
                            @error('course_description')
                                    <div class="alert alert-danger"> Это поле необходимо заполнить!</div>
                            @enderror
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Создать курс
                                </button>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
