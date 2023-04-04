@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content">
        <div class="col-md-8">
            <div class="row mb-3">
                @if (count($data) != 0)
                    @foreach ($data as $elem)
                        <div class="alert loginInputs">
                            <a href="{{ route('manage_course', ['course_id'=>$elem->id]) }}" class="loginInputs">
                                <h3 >Название: {{ $elem->course_name }}</h3>
                                <h3 >Описание: {{ $elem->course_description }}</h3>
                            </a>
                        </div>
                    @endforeach

                @else
                    <h3>Вы еще не создали курс </h3>
                @endif

            </div>
        </div>
    </div>
    <a href={{route('create_course')}} class="btn btn-login mb-0">Создать курс</a>

</div>


@endsection
