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
                            <label for="course_name" class="col-md-4 col-form-label text-md-end">'Название курса'</label>

                            <div class="col-md-6">
                                <input id="course_name" type="text" class="form-control" name="course_name" value="">

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="course_description" class="col-md-4 col-form-label text-md-end">Описание курса</label>

                            <div class="col-md-6">
                                <textarea rows="4", cols="54" id="course_description" class="form-control" name="course_description"></textarea>
                            </div>
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
