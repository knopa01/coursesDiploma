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
                            @php

                            //dd($data[0]);
                            //dd($data[0]->content_name);
                            @endphp
                            <div class="alert alert-info">
                                @if ($data[0]->type_of_content == "lecture")
                                    <h3 id="content_type">Теория</h3>
                                @else
                                    <h3 id="content_type">Задача</h3>
                                @endif

                                <div class="row mb-3">
                                    <label for="content_name" class="col-md-4 col-form-label text-md-end">Название</label>
                                    <div class="col-md-6">
                                        <input id="content_name" type="text" class="form-control" name="content_name" value="{{$data[0]->content_name}}">


                                    </div>
                                    <input id="content_type" type="hidden" class="form-control" name="content_type" value={{$data[0]->type_of_content}}>
                                    <input id="content_id" type="hidden" class="form-control" name="content_id" value={{$data[0]->id}}>
                                    <input id="course_id" type="hidden" class="form-control" name="course_id" value={{$course_id}}>
                                </div>
                                <div class="row mb-3">
                                    <label for="content_description" class="col-md-4 col-form-label text-md-end">Содержание</label>
                                    <div class="col-md-6">
                                        <textarea id="content_description" class="form-control ckeditor" name="content_description">{{$data[0]->content_description}}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="sort" class="col-md-4 col-form-label text-md-end">Порядок</label>
                                    <div class="col-md-6">
                                        <input id="sort" type="number" min=1 class="form-control" name="sort" value={{$data[0]->sort}}>
                                        @error('sort')
                                            <div class="alert alert-danger"> Данный порядковый номер уже существует!</div>
                                        @enderror
                                    </div>
                                </div>


                                @if ($data[0]->type_of_content=="task")
                                    <h3>Тесты</h3>
                                    @if ($tests)
                                    @php $i = 0 @endphp
                                        @foreach ($tests as $test)
                                            @php $i += 1 @endphp
                                            <div class="alert alert-info">
                                                <div>
                                                    <a href="{{ route('manage_test', ['course_id'=>$course_id, 'content_id'=>$data[0]->id, 'test_id'=>$test->id]) }}">
                                                        <p>№ {{$i}}  Входные данные:{{ $test->test_input }}  Выходные данные:{{ $test->test_output }}</p>

                                                    </a>
                                                </div>

                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="row mb-3">
                                        <div class="col-md-8 offset-md-4">
                                            <a href="{{ route('create_test', ['course_id'=>$course_id, 'content_id'=>$data[0]->id])}}"class="btn btn-primary">Добавить тест</a>
                                        </div>
                                    </div>
                                @endif
                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        @if ($data[0]->type_of_content == "task")
                                            <a href="{{ route('delete_content', ['content_id'=>$data[0]->id]) }}">Удалить задачу</a>
                                        @else
                                            <a href="{{ route('delete_content', ['content_id'=>$data[0]->id]) }}">Удалить теорию</a>
                                        @endif
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
