@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content">
        <form method="POST" action="{{ route('find_student')}}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-10">
                    <input type="text" class="form-control" id="search" name="name">
                    <input type="hidden" class="form-control" id="course_id" name="course_id" value={{$course_id}}>
                    <button type="submit" class="btn btn-primary btn-block">Найти</button>
                </div>

            </div>

        </form>
        <div class="col-md-8">
            <div class="row mb-3">
                <div>
                    <h3>Студенты, которые прошли данный курс:</h3>

                    @if (count($done) != 0)
                        @foreach ($done as $elem)
                            <div class="alert alert-info">
                                <div>
                                    <h3>Студент: {{ $elem["student"]->name }}</h3>
                                    <h3>Дата выполнения: {{ $elem["course"]->done_date }}</h3>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3>Студенты еще не прошли этот курс. </h3>
                    @endif
                </div>
                <div>
                    <h3>Студенты, которые проходят этот курс:</h3>

                    @if (count($in_progress) != 0)
                        @foreach ($in_progress as $elem)
                            <div class="alert alert-info">
                                <div>
                                    <h3>Студент: {{ $elem["student"]->name }}</h3>
                                    @foreach ($elem["tasks"] as $task)
                                        <h3>Задача: {{ $task["task_name"] }}</h3>
                                        <h3>Дата выполнения: {{ $task["task_info"]->done_date }}</h3>
                                    @endforeach

                                </div>
                            </div>
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
