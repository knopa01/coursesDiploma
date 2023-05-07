@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content">
        <div class="col-12">
            <div class="card">
                <div class="position-relative">
                    <div class="card-header ms-4"> Результат:
                        @php
                            $url = request()->headers->get('referer');
                            $parts = parse_url( $url );
                        @endphp
                        @if($parts["path"] == "/study-results/search")
                            <a href="{{route("study_results")}}" class="position-absolute top-2 start-0 ms-3" >
                                <img src="/images/back.png" height="20" class="img-back">
                            </a>
                        @elseif($parts["path"] == "/study-results/group")
                            <a href="{{ route('group_results', ['course_id'=>$course_id, 'group_id'=>$group_id]) }}" class="position-absolute top-2 start-0 ms-3" >
                                <img src="/images/back.png" height="20" class="img-back">
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert">
                        <div class="alert">
                            <form method="POST" class="mt-2" action="{{ route('find_student')}}">
                                @csrf
                                <label for="name" class="col-12 col-form-label">{{ __('Имя студента:') }}</label>
                                <div class="row mb-3">
                                    <input type="text" class="input_size col-12 col-sm-4 me-1 size_input loginInputs" id="name" name="name">
                                    <input type="hidden" class="form-control" id="course_id" name="course_id" value={{$course_id}}>
                                    <button type="submit" style="width: 10vw; min-width: 100px " class="col-2 button_size btn btn-login">Найти</button>
                                </div>
                            </form>
                        </div>
                        <div class="alert card">
                            <div class="col-md-12">
                                <div class="row mb-3">
                                        @if ($msg == "Пользователь не найден!")
                                            <h3>{{$msg}}</h3>
                                        @elseif($msg == "Введите имя студенета!")
                                            <h3>{{$msg}}</h3>
                                        @else
                                        <h3>Студент: {{ $student_info->name }}</h3>
                                        <h3>Группа {{$group_name}}</h3>
                                            @if (count($in_progress) != 0)
                                                @if($in_progress[0]["course"]->done_date != null)
                                                    <h4>Курс пройден: {{$in_progress[0]["course"]->done_date}}</h4>
                                                @else
                                                    <h4>Процент выполненных задач: {{$in_progress[0]["percent"]}}%</h4>
                                                @endif
                                                @foreach ($in_progress as $elem)
                                                    <div class="col-md-12 mt-2 ">
                                                        @foreach ($elem["tasks"] as $task)
                                                            <div class="alert course-content">
                                                                <h3>Задача: {{ $task["task_name"] }}</h3>
                                                                <h3>Дата выполнения: {{ $task["task_info"]->done_date }}</h3>
                                                            </div>
                                                        @endforeach
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

            </div>
        </div>


    </div>
</div>
@endsection
