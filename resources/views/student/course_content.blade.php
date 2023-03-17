@extends('layouts.app')
@section('content')
    <p>{{$course_data->course_name}}</p>
    <p>{{$teacher}}</p>
    <p>{{$course_data->course_description}}</p>



    @if ($course_content)
        <p>Содержание:</p>
        @foreach ($course_content as $content)
            <a href="{{ route('show_content', ['course_id'=>$course_data->id, 'course_name'=>$course_data->course_name, 'content_id'=>$content->id ])}}">{{$content->name}}</a><br>
        @endforeach
    @endif
@endsection
