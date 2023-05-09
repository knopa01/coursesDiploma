@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content">
        <div class="col-12">
            <div class="card">
                <div class="position-relative">
                    <div class="card-header ms-4">Информация о курсе
                        <a href="{{route("find_course")}}" class="position-absolute top-2 start-0 ms-3" >
                            <img src="/images/back.png" height="20" class="img-back">
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($data) != 0)
                        <form method="POST" action="{{ route('add_course') }}">
                            @csrf

                            <div class="alert course">
                                <h3>Название курса: {{ $data["course"]->course_name }}</h3>
                                <h3>Описание курса: {{ $data["course"]->course_description }}</h3>
                                <h3>Преподаватель: {{ $data["teacher"] }}</h3>
                                <input type="hidden" class="form-control" id="course_id" name="course_id" value={{$data["course"]->id}}>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-primary btn-login">Начать изучение</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <h3>Данного курса не существует!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
