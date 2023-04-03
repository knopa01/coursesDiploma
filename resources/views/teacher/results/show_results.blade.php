@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content">
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

                    @if (count($tasks_in_progress) != 0)
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


                    @else
                        <h3>Студенты еще не прошли этот курс. </h3>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
