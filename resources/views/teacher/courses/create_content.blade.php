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

                            <div class="alert alert-info">

                                <div class="row mb-3">
                                    <label for="content_name" class="col-md-4 col-form-label text-md-end">Название</label>
                                    <div class="col-md-6">
                                        <input id="content_name" type="text" class="form-control" name="content_name" value="">
                                        <input id="course_id" type="text" class="form-control" name="course_id" value={{$course_id}}>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="content_type" class="col-md-4 col-form-label text-md-end">{{ __('Вы являетесь') }}</label>

                                    <select id="content_type" name="content_type">
                                        <option selected>Выберите значение</option>
                                        <option value="lecture">Теория</option>
                                        <option value="task">Задача</option>
                                    </select>

                                </div>
                                <div class="row mb-3">
                                    <label for="content_description" class="col-md-4 col-form-label text-md-end">Содержание</label>
                                    <div class="col-md-6">
                                        <textarea id="content_description" class="form-control" name="content_description"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <input id="content_sort" type="number" class="form-control" name="content_sort" value="">
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            ОК
                                        </button>

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
