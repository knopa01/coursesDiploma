@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('add_course') }}">
    @csrf
    <div class="alert alert-info">

        <h3>Название курса: {{ $data["course"]->course_name }}</h3>
        <h3>Описание курса: {{ $data["course"]->course_description }}</h3>
        <h3>Преподаватель: {{ $data["teacher"] }}</h3>

    </div>
    <div class="form-row">
        <div class="form-group col-md-10">
            <input type="hidden" class="form-control" id="course_id" name="course_id" value={{$data["course"]->id}}>
        </div>
        <div class="form-group col-md-2">
            <button type="submit" class="btn btn-primary btn-block">Начать изучение</button>
        </div>
    </div>
</form>



@endsection
