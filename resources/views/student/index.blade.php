@extends('layouts.app')
@section('content')

@if ($data)
    @foreach ($data as $elem)
        <div class="alert alert-info">
            {{--
            <a href="{{ route('manage_course', ['course_id'=>$elem->id]) }}">
                <h3>{{ $elem->course_name }}</h3>
                <h3>{{ $elem->course_description }}</h3>
            </a>
            --}}
            <h3>{{ $elem->course_name }}</h3>
            <h3>{{ $elem->course_description }}</h3>
        </div>
    @endforeach
@endif
<div class="btn">
    <a href={{route('add_course')}}>Добавить курс</a>
</div>
@endsection
