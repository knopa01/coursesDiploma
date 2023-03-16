@extends('layouts.app')
@section('content')
@if ($data)
    @foreach ($data as $d)
        <div class="alert alert-info">

            <a href="{{ route('course_info', ['course_id'=>$d["course"]->id])}}">
                <h3>{{ $d["course"]->course_name }}</h3>
                <h3>Преподаватель: {{ $d["teacher"] }}</h3>
            </a>
        </div>
    @endforeach
@else
    <h3>По Вашему запросу ничего не найдено</h3>
@endif
@endsection
