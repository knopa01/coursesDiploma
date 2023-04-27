@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Добавить тест') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('created_test', ['course_id'=>$course_id, 'content_id'=>$content_id]) }}">
                        @csrf

                        <div class="alert ">
                            <div class="row mb-3">
                                <label for="test_input" class="col-md-4 col-form-label text-md-end">Входные данные</label>
                                <div class="col-md-6">
                                    <input id="test_input" type="text" class="loginInputs form-control" name="test_input" value="">
                                    <input id="content_id" type="hidden" class="form-control" name="content_id" value={{$content_id}}>
                                    <input id="course_id" type="hidden" class="form-control" name="course_id" value={{$course_id}}>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="test_output" class="col-md-4 col-form-label text-md-end">Выходные данные</label>
                                <div class="col-md-6">
                                    <input id="test_output" type="text" class="loginInputs form-control" name="test_output" value="">
                                </div>

                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-save">
                                        Создать
                                    </button>
                                    <a class="btn btn-cancel ms-1" href="{{route("manage_content", ["course_id"=>$course_id, "content_id"=>$content_id])}}">Отмена</a>
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
