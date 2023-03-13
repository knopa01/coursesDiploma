@extends('layouts.app')
@section('content')
<div class="card-body">
    <form method="POST" action="{{ route('edit_course') }}">
        @csrf
        <div class="alert alert-info">
            <div class="row mb-3">
                <label for="course_name" class="col-md-4 col-form-label text-md-end">Название курса:</label>
                <div class="col-md-6">
                    <input id="course_name" type="text" class="form-control" name="course_name" value={{$course->course_name}}>
                    <input id="course_id" type="hidden" class="form-control" name="course_id" value={{$course->id}}>
                </div>
            </div>
            <div class="row mb-3">
                <label for="course_description" class="col-md-4 col-form-label text-md-end">Описание курса</label>
                <div class="col-md-6">
                    <input id="course_description" type="text" class="form-control" name="course_description" value={{$course->course_description}}>
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
@if ($data)
    @foreach ($data as $elem)
        <div class="alert alert-info">
            <div>
                <a href="{{ route('manage_content', ['course_id'=>$course_id, 'content_id'=>$elem->id]) }}">
                    <h3>{{ $elem->name }}</h3>

                </a>
            </div>

        </div>
    @endforeach
@endif
<div class="btn">
    <a href="{{ route('create_content', ['course_id'=>$course_id]) }}">Создать лекцию/задачу</a>

</div>
@endsection
