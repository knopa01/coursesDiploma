@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content">
        <form method="POST" action="{{ route('find_student')}}">
            @csrf

                <div class="row mb-3">

                    <h3>Имя студента:</h3>
                    <div class="form-group col-md-10">

                        <input type="text" class="form-control" id="name" name="name">
                        <input type="hidden" class="form-control" id="course_id" name="course_id" value={{$course_id}}>
                        <button type="submit" class="btn btn-primary btn-block">Найти</button>
                    </div>
                </div>



        </form>
        <div class="col-md-8">
            <div class="row mb-3">

                <div>
                    @if (count($in_progress) != 0)
                        <h3>Студенты, которые проходят этот курс:</h3>
                        @foreach ($in_progress as $elem)
                            <form method="POST" action="{{ route('find_student')}}">
                                @csrf
                                    <input type="hidden" class="form-control" name="name" value="{{ $elem["student"]->name }}">
                                    <input type="hidden" class="form-control" name="course_id" value={{$course_id}}>

                                    <button type="submit" class="alert loginInputs">
                                    <div class="alert loginInputs">
                                        <h2>Студент: {{ $elem["student"]->name }}</h2>
                                        @if($elem["course"]->done_date != null)
                                            <h3>Курс пройден: {{$elem["course"]->done_date}}</h3>
                                        @else
                                            @if ($elem["tasks"] == null)
                                                <h3>Студент не решил ни одной задачи.</h3>
                                            @else
                                                <h3>Студент проходит курс.</h3>
                                                {{--
                                                @foreach ($elem["tasks"] as $task)
                                                    <h3>Задача: {{ $task["task_name"] }}</h3>
                                                    <h3>Дата выполнения: {{ $task["task_info"]->done_date }}</h3>
                                                @endforeach
                                                --}}
                                            @endif
                                        @endif
                                    </div>
                                    </button>
                            </form>

                        @endforeach

                    {{--
                    @foreach ($courses_in_progress as $course)
                        <div class="alert alert-info">
                        <h2>Студент id: {{ $course->user_id }}</h3>
                            @foreach ($tasks_in_progress as $task)
                                @if ($task->student_course_id == $course->id)
                                    <h3>Задача: {{ $task->id }}</h3>
                                    <h3>Дата выполнения: {{ $task->done_date }}</h3>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                        --}}

                    @else
                        <h3>Студенты еще не прошли этот курс. </h3>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
