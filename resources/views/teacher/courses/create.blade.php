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
                                <input id="course_name" type="text" class=" loginInputs form-control @error('course_name') is-invalid @enderror" name="course_name" value="{{old('course_name')}}" >

                                @error('course_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                    </span>
                                @enderror


                                {{--
                                @if ($errors->any())
                                    <div class="alert alert-danger">

                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                                @break
                                            @endforeach

                                    </div>
                                @endif
                                --}}

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="language_id" class="col-md-4 col-form-label text-md-end">{{ __('Выберете язык') }}</label>
                            <div class="col-md-6">

                                <select id="language_id" name="language_id" class= " select-style @error('language_id') is-invalid @enderror">

                                    @foreach ($languages as $language)
                                        <option class="options" value={{$language->id}}>{{$language->language_name}}</option>

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
                                <textarea id="course_description" class="form-control description description @error('course_description') is-invalid @enderror" name="course_description">{{old('course_description')}}</textarea>
                                @error('course_description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror

                                <script>
                                    CKEDITOR.replace( 'course_description' );


                                </script>
                            </div>




                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-save">
                                    Создать курс
                                </button>
                                <a href="{{route("home")}}" class="btn btn-cancel ms-1">Отмена</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
