@extends('layouts.app')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="position-relative">
                        <div class="card-header ms-4">{{ __('Данные курса') }}
                            <a href="{{route("home")}}" class="position-absolute top-2 start-0 ms-3" >
                                <img src="/images/back.png" height="20" class="img-back">
                            </a>
                        </div>
                    </div>
                        <div class="card-body ">
                            <div class="alert ">
                                <div class="row mb-3">
                                    <h2>{{$course_data->course_name}}</h2>
                                    <h3 class="mt-4">Преподаватель: {{$teacher}}</h3>
                                    <h3 class="mt-4"> Описание курса:</h3>
                                    <pre style="font-size: 25px">{!! $course_data->course_description !!}</pre>
                                </div>
                            </div>
                            <div class="text-center ">
                                @if ($course_content)
                                    <div class="card">
                                        <h4>Содержание:</h4>
                                        @foreach ($course_content as $content)
                                            <div class=" mt-2  align-self-center w-75">
                                                <div class="alert course-content ">
                                                    <h5 class="text-center">{{$content->content_name}}</h5>

                                                </div>
                                            </div>

                                        @endforeach
                                    </div>




                                @endif

                            </div>
                            <div style="margin-top: 50px;">
                                <a href="{{ route('show_content', ['course_id'=>$course_data->id, 'student_course_id'=>$student_course_id])}}" class="btn btn-login ">Начать обучение</a>
                                <a href="{{ route('delete_student_course', ['student_course_id'=>$student_course_id, 'course_id'=>$course_data->id]) }}" class="btn btn-cancel ms-2" >Удалить курс</a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection
