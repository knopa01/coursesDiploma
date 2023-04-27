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
                                        <input id="content_name" type="text" class=" loginInputs form-control @error('content_name') is-invalid @enderror" name="content_name" value="{{old('content_name')}}">
                                        <input id="course_id" type="hidden" class="form-control" name="course_id" value={{$course_id}}>
                                        @error('content_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label for="content_type" class="col-md-4 col-form-label text-md-end">{{ __('Тип:') }}</label>
                                    <div class="col-md-4">
                                        <select id="content_type" class =" select-style @error('content_type') is-invalid @enderror" name="content_type">
                                            <option disabled>Выберите значение</option>
                                            <option value="lecture">Теория</option>
                                            <option value="task">Задача</option>
                                        </select>
                                        @error('content_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="content_type" class="col-md-4 col-form-label text-md-end">{{ __('Порядковый номер:') }}</label>
                                    <div class="col-md-3">
                                        <input id="content_sort" type="number"  class=" loginInputs form-control @error('content_sort') is-invalid @enderror" name="content_sort" value="">
                                        @error('content_sort')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label for="content_description" class="col-md-4 col-form-label text-md-end">Содержание</label>
                                        {{--
                                        <div class="col-md-6">
                                        <textarea id="content_description" class="form-control" name="content_description"></textarea>
                                    </div>
                                        -
                                        --}}
                                </div>



                                            {{--<textarea class=" loginInputs ckeditor form-control"  class="@error('content_description') is-invalid @enderror" name="content_description"></textarea>--}}
                                <textarea id="content_description" class="form-control description description @error('content_description') is-invalid @enderror" name="content_description">{{old('content_description')}}</textarea>
                                <script>
                                    CKEDITOR.replace( 'content_description' );


                                </script>
                                @error('content_description')

                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </span>
                                @enderror





                                {{--
                                <div id="editor">This is some sample content.</div>
                                <script>
                                    ClassicEditor
                                        .create( document.querySelector( '#editor' ) )
                                        .then( editor => {
                                            console.log( editor );
                                        } )
                                        .catch( error => {
                                            console.error( error );
                                        } );
                                </script>
                                --}}

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4 mt-2">
                                        <button type="submit" class="btn btn-save">
                                            Сохранить
                                        </button>
                                        <a href="{{route("manage_course", ["course_id" => $course_id])}}" class="btn btn-cancel">Отмена</a>

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
