@extends('layouts.app')
@section('content')
я учитель

@foreach ($data as $elem)
    <div class="alert alert-info">
        <a href="{{ route('manage_course', ['course_id'=>$elem->id]) }}">
            <h3>{{ $elem->course_name }}</h3>
            <h3>{{ $elem->course_description }}</h3>
        </a>

    </div>
@endforeach
<div class="btn">
    <a href={{route('create_course')}}>Создать курс</a>
</div>
@endsection
