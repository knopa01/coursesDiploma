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

                            @if(count($data) != 0)
                                <div class="col-md-4 d-flex">
                                        @if ($data[0]->type_of_content == "lecture")
                                            <h3 id="content_type" class="d-inline-block">Теория</h3>
                                        @else
                                            <h3 id="content_type" class="d-inline-block">Задача</h3>
                                        @endif
                                        <a href="{{route("manage_course", ["course_id"=>$course_id])}}" class="btn btn-login d-inline-block ms-2">Назад</a>
                                </div>
                                    <div class="row mb-3">
                                        <label for="content_name" class="col-md-4 col-form-label text-md-end">Название</label>
                                        <div class="col-md-6">
                                            <input id="content_name" type="text" class="form-control loginInputs" name="content_name" value="{{$data[0]->content_name}}">
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
                                            <input id="sort" type="number" min=1 class="form-control loginInputs" name="sort" value={{$data[0]->sort}}>
                                            @error('sort')
                                                <div class="alert alert-danger"> Данный порядковый номер уже существует!</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-save">
                                                Сохранить
                                            </button>
                                            @if ($data[0]->type_of_content == "task")
                                                <a href="{{ route('delete_content', ['content_id'=>$data[0]->id]) }}" class="btn btn-danger ms-2">Удалить задачу</a>
                                            @else
                                                <a href="{{ route('delete_content', ['content_id'=>$data[0]->id]) }}" class="btn btn-danger ms-2">Удалить теорию</a>
                                            @endif
                                        </div>
                                    </div>

                                    @if ($data[0]->type_of_content=="task")
                                        <div class="alert card mt-4">
                                            <h4>Тесты</h4>
                                            @if ($tests)
                                            @php $i = 0 @endphp
                                                @foreach ($tests as $test)
                                                    @php $i += 1 @endphp
                                                    <div class="alert loginInputs ">
                                                        <div class="col-md-8">
                                                            <a href="{{ route('manage_test', ['course_id'=>$course_id, 'content_id'=>$data[0]->id, 'test_id'=>$test->id]) }}" class="loginInputs">
                                                                {{--
                                                                <h5>№ {{$i}}</h5>
                                                                <h5>Входные данные: {{ $test->test_input }} Выходные данные: {{ $test->test_output }}</h5>
                                                                --}}
                                                                <h5>№ {{$i}} Входные данные: {{ $test->test_input }}</h5>
                                                                <h5>Выходные данные: {{ $test->test_output }}</h5>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="row mb-3">
                                                <div class="col-md-8">
                                                    <a href="{{ route('create_test', ['course_id'=>$course_id, 'content_id'=>$data[0]->id])}}"class="btn btn-primary">Добавить тест</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endif
@endsection
