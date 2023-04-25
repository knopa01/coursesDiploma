@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Создание') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('created_content') }}">
                            @csrf

                            <div class="alert ">

                                <div class="row mb-3">
                                    <label for="content_name" class= "col-md-4 col-form-label text-md-end">Название</label>
                                    <div class="col-md-6">
                                        <input id="content_name" type="text" class=" loginInputs form-control @error('content_name') is-invalid @enderror" name="content_name" value="">
                                        <input id="course_id" type="hidden" class="form-control" name="course_id" value={{$course_id}}>
                                        @error('content_name')
                                            <div class="alert alert-danger"> Это поле необходимо заполнить!</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label for="content_type" class="col-md-4 col-form-label text-md-end">{{ __('Тип:') }}</label>
                                    <div class="col-md-6">
                                        <select id="content_type" class =" select-style @error('content_type') is-invalid @enderror" name="content_type">
                                            <option disabled>Выберите значение</option>
                                            <option value="lecture">Теория</option>
                                            <option value="task">Задача</option>
                                        </select>
                                        @error('content_type')
                                            <div class="alert alert-danger"> Пожалуйста, выберете тип контента</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="content_type" class="col-md-4 col-form-label text-md-end">{{ __('Порядковый номер:') }}</label>
                                    <div class="col-md-3">
                                        <input id="content_sort" type="number" min=1 class=" loginInputs form-control @error('content_sort') is-invalid @enderror" name="content_sort" value="">
                                        @error('content_sort')
                                        <div class="alert alert-danger"> Пожалуйста, введите число!</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <label for="content_description" class="col-md-4 col-form-label text-md-end">Содержание</label>
                                    {{--
                                        <div class="col-md-6">
                                        <textarea id="content_description" class="form-control" name="content_description"></textarea>
                                    </div>
                                        --}}


                                        <div class="form-group">
                                            <textarea class=" loginInputs ckeditor form-control"  class="@error('content_description') is-invalid @enderror" name="content_description"></textarea>
                                            @error('content_description')
                                                <div class="alert alert-danger"> Это поле необходимо заполнить!</div>
                                            @enderror
                                        </div>


                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-save">
                                            Сохранить
                                        </button>
                                        <a href="{{route("manage_course", ["course_id" => $course_id])}}" class="btn btn-danger">Отмена</a>

                                    </div>
                                </div>


                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
