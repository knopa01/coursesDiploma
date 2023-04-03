@extends('layouts.app')
@section('content')
    <p>{{$course_data->course_name}}</p>
    <p>{{$teacher}}</p>
    <p>{{$course_data->course_description}}</p>



    @if ($course_content)
        <p>Содержание:</p>
        @foreach ($course_content as $content)
            <p >{{$content->content_name}}</p><br>
        @endforeach
        <a href="{{ route('show_content', ['course_id'=>$course_data->id, 'student_course_id'=>$student_course_id])}}" class="btn btn-primary ">Начать обучение</a>
        <a href="{{ route('delete_student_course', ['student_course_id'=>$student_course_id]) }}" class="btn btn-danger" >Удалить курс</a>
    @endif
@endsection
