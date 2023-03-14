@extends('layouts.app')
@section('content')
<form action="{{ route('find_course')}}">
    <div class="form-row">
        <div class="form-group col-md-10">
            <input type="text" class="form-control" id="search" name="name">
        </div>
        <div class="form-group col-md-2">
            <button type="submit" class="btn btn-primary btn-block">Найти</button>
        </div>
    </div>

</form>
@if ($courses)

    @foreach ($courses as $course)
        @foreach ($teachers as $teacher)
            <div class="alert alert-info">
                <a href="#">
                    <h3>{{ $course->course_name }}</h3>
                    <h3>{{ $teacher }}</h3>
                </a>

            </div>
        @endforeach
    @endforeach

@else
    <h3>По Вашему запросу ничего не найдено</h3>
@endif
@endsection
