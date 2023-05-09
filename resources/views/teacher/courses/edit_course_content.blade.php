@extends('layouts.app')
@section('content')
@if ($data)

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="position-relative">
                        <div class="card-header ms-4">{{ __('Редактирование') }}
                            <a href="{{route("manage_course", ["course_id"=>$course_id])}} " class="position-absolute top-5 start-0 ms-3 " >
                                <img src="/images/back.png" height="20" class="img-back">
                            </a>


                        </div>
                    </div>

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
                                    </div>



                                    <div class="row mb-3">
                                        <label for="content_name" class="col-md-4 col-form-label text-md-end">Название</label>
                                        <div class="col-md-6">
                                            <input id="content_name" type="text" class="form-control loginInputs @error('content_name') is-invalid @enderror" name="content_name" value="{{$data[0]->content_name}}">
                                            @error('content_name')

                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <input id="content_type" type="hidden" class="form-control" name="content_type" value={{$data[0]->type_of_content}}>
                                        <input id="content_id" type="hidden" class="form-control" name="content_id" value={{$data[0]->id}}>
                                        <input id="course_id" type="hidden" class="form-control" name="course_id" value={{$course_id}}>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="sort" class="col-md-4 col-form-label text-md-end">Порядок</label>
                                        <div class="col-md-6">
                                            <input id="sort" type="number"  class="form-control loginInputs @error('sort') is-invalid @enderror" name="sort" value={{$data[0]->sort}}>
                                            @error('sort')

                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                        <label for="content_description" class="col-md-4 col-form-label text-md-end">Содержание</label>
                                        <textarea id="content_description" class="form-control description description @error('content_description') is-invalid @enderror" name="content_description">{{$data[0]->content_description}}</textarea>
                                        <script>
                                            CKEDITOR.replace( 'content_description' );


                                        </script>
                                        @error('content_description')

                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </span>
                                        @enderror


                                        <div class="col-md-8 offset-md-4 mt-2">
                                            <button type="submit" class="btn btn-save">
                                                Сохранить
                                            </button>
                                            @if ($data[0]->type_of_content == "task")
                                                <a href="{{ route('delete_content', ['content_id'=>$data[0]->id, 'course_id'=>$course_id]) }}" class="btn btn-cancel ms-1">Удалить задачу</a>
                                            @else
                                                <a href="{{ route('delete_content', ['content_id'=>$data[0]->id, 'course_id'=>$course_id]) }}" class="btn btn-cancel ms-1">Удалить теорию</a>
                                            @endif
                                        </div>


                                    @if ($data[0]->type_of_content=="task")
                                        <div class="alert card mt-4">
                                            <h4>Тесты</h4>
                                            @if ($tests)
                                            @php $i = 0 @endphp
                                                @foreach ($tests as $test)
                                                    @php $i += 1 @endphp
                                                    <div class="alert course-content col-md-12">
                                                        <a href="{{ route('manage_test', ['course_id'=>$course_id, 'content_id'=>$data[0]->id, 'test_id'=>$test->id]) }}" class="text-decoration-none text-white">


                                                                {{--
                                                                <h5>№ {{$i}}</h5>
                                                                <h5>Входные данные: {{ $test->test_input }} Выходные данные: {{ $test->test_output }}</h5>
                                                                --}}
                                                                <h5>№ {{$i}} Входные данные: {{ $test->test_input }}</h5>
                                                                <h5>Выходные данные: {{ $test->test_output }}</h5>


                                                        </a>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="row mb-3">
                                                <div class="col-md-8">
                                                    <a href="{{ route('create_test', ['course_id'=>$course_id, 'content_id'=>$data[0]->id])}}"class="btn btn-login">Добавить тест</a>
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
