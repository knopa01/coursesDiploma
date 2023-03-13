@extends('layouts.app')
@section('content')
@if ($data)

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Редактирование') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('edit_test') }}">
                            @csrf

                            <div class="alert alert-info">

                                <div class="row mb-3">
                                    <label for="test_input" class="col-md-4 col-form-label text-md-end">Входные данные</label>
                                    <div class="col-md-6">
                                        <input id="test_input" type="text" class="form-control" name="test_input" value={{$data[0]->test_input}}>
                                        <input id="content_id" type="hidden" class="form-control" name="content_id" value={{$content_id}}>
                                        <input id="course_id" type="hidden" class="form-control" name="course_id" value={{$course_id}}>
                                        <input id="test_id" type="hidden" class="form-control" name="test_id" value={{$data[0]->id}}>

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="content_description" class="col-md-4 col-form-label text-md-end">Выходные данные</label>
                                    <div class="col-md-6">
                                        <input id="test_output" type="text" class="form-control" name="test_output" value={{$data[0]->test_output}}>
                                    </div>

                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <a href="{{ route('delete_test', ['test_id'=>$data[0]->id]) }}">Удалить тест</a>
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


@endif
@endsection
