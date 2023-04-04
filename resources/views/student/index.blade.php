@extends('layouts.app')
@section('content')


<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Мои курсы') }}</div>
                <div class="card-body ">
                    @if ($data)
                        @foreach ($data as $elem)
                            <div class="alert loginInputs">
                                <a href="{{ route('course_content', ['course_id'=>$elem["course_id"], 'student_course_id'=>$elem["student_course_id"]]) }}" class="loginInputs">
                                    <h3>{{ $elem["course_name"] }}</h3>
                                    <h3>Преподаватель: {{ $elem["teacher"] }}</h3>
                                </a>
                            </div>
                        @endforeach
                    @endif
                    <div class="row mb-0">
                        <div class="col align-self-start">
                            <a href={{route('search_course')}} class="btn btn-login ">Добавить курс</a>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


@endsection
