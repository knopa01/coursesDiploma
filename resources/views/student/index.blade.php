@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Мои курсы') }}</div>
                <div class="card-body ">
                    @if (count($data) != 0)
                        <div class="row gx-5">
                            @php($i = 1)
                            @foreach ($data as $elem)
                                <div class="col-md-4 gy-3">
                                    <a href="{{ route('course_content', ['course_id'=>$elem["course_id"], 'student_course_id'=>$elem["student_course_id"]]) }}" class="text-center text-decoration-none text-white">
                                        <div class="alert course ">
                                            <h3>{{ $elem["course_name"] }}</h3>
                                            <h3>Преподаватель: {{ $elem["teacher"] }}</h3>
                                        </div>
                                    </a>
                                </div>
                                @if($i % 3 == 0)
                                    </div><div class="row gx-5">
                                @php($i++)
                                @endif
                            @endforeach
                        </div>
                    @else
                        <h3>Вы еще не проходите курсы </h3>
                    @endif
                    <div class="row mb-0">
                        <div class="col align-self-start">
                            <a href="{{route('find_course')}}" class="btn btn-login">Добавить курс</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


@endsection
