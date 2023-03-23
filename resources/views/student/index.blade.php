@extends('layouts.app')
@section('content')

@if ($data)
    @foreach ($data as $elem)
        <div class="alert alert-info">

            <a href="{{ route('course_content', ['course_id'=>$elem["course_id"]]) }}">
                <h3>{{ $elem["course_name"] }}</h3>
                <h3>Преподаватель: {{ $elem["teacher"] }}</h3>
            </a>
        </div>
    @endforeach
@endif
<div class="btn">
    <a href={{route('search_course')}}>Добавить курс</a>
</div>
@endsection
