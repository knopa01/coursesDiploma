@extends('layouts.app')
@section('content')
    <div class="row mb-0">

        <div class="col-md-8 offset-md-4">
            <h3>{{$message}}</h3>
            @if ($ctrl == "course")
                <a href="{{ route('home')}}"class="btn btn-primary">OK</a>
            @elseif ($ctrl == "content")
                <a href="{{ route('manage_course', ['course_id'=>$course_id])}}"class="btn btn-primary">OK</a>
            @elseif ($ctrl == "test")
                <a href="{{ route('manage_content', ['course_id'=>$course_id, 'content_id'=>$content_id]) }}" class="btn btn-primary">OK</a>
            @endif

        </div>
    </div>
@endsection
