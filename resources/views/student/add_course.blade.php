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
@if ($data)

    @foreach ($data as $d)
        <form action="{{ route('course_info')}}">
            <button type="submit" class="btn btn-primary btn-block">
                <h3>{{ $d["course"]->course_name }}</h3>
                <h3>Преподаватель: {{ $d["teacher"] }}</h3>
            </button>
        </form>


    @endforeach

@else
    <h3>По Вашему запросу ничего не найдено</h3>
@endif
@endsection
