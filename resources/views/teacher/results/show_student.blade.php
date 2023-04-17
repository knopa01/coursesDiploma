@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content">
        <form method="POST" action="{{ route('find_student')}}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-10">
                    <label for="name" class="col-md-4 col-form-label text-md-end">Имя студента:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$name}}">
                    <input type="hidden" class="form-control" id="course_id" name="course_id" value={{$course_id}}>
                    <button type="submit" class="btn btn-primary btn-block">Найти</button>
                </div>

            </div>

        </form>
        <div class="col-md-8">
            <div class="row mb-3">

                <div>
                    @if ($msg == "Пользователь не найден!")
                        <h3>{{$msg}}</h3>
                    @elseif($msg == "Введите имя студенета!")
                        <h3>{{$msg}}</h3>
                    @else
                        @if (count($in_progress) != 0)

                        @foreach ($in_progress as $elem)
                            <div class="alert alert-info">
                                <div>
                                    <h3>Студент: {{ $elem["student"]->name }}</h3>
                                    @if($elem["course"]->done_date != null)
                                        <h3>Курс пройден: {{$elem["course"]->done_date}}</h3>

                                    @endif
                                    @if($elem["tasks"] == null)
                                        <h3>Студент еще не решил задачи.</h3>
                                    @else
                                        @foreach ($elem["tasks"] as $task)
                                            <h3>Задача: {{ $task["task_name"] }}</h3>
                                            <h3>Дата выполнения: {{ $task["task_info"]->done_date }}</h3>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        @endforeach
                        @else
                            <h3>Студент еще не начал изучать курс. </h3>
                        @endif
                    @endif


                </div>

            </div>
        </div>
    </div>
</div>
@endsection
