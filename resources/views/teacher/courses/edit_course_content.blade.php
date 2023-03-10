@extends('layouts.app')
@section('content')
@if ($data)

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Редактирование') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('edit_content') }}">
                            @csrf

                            <div class="alert alert-info">
                                <h3 id="content_type">{{$data[0]->type_of_content}}</h3>
                                <div class="row mb-3">
                                    <label for="content_name" class="col-md-4 col-form-label text-md-end">Название</label>
                                    <div class="col-md-6">
                                        <input id="content_name" type="text" class="form-control" name="content_name" value={{$data[0]->name}}>
                                        <input id="content_type" type="hidden" class="form-control" name="content_type" value={{$data[0]->type_of_content}}>
                                        <input id="content_id" type="hidden" class="form-control" name="content_id" value={{$data[0]->id}}>
                                        <input id="course_id" type="hidden" class="form-control" name="course_id" value={{$course_id}}>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="content_description" class="col-md-4 col-form-label text-md-end">Содержание</label>
                                    <div class="col-md-6">
                                        <textarea id="content_description" class="form-control" name="content_description">{{$data[0]->description}}</textarea>
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
