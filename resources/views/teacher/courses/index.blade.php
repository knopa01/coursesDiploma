@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content">
        <div class="col-md-12">
            <div class="container">
                <h2 >Мои курсы:</h2>
                @if ($data->count() != 0)
                    <div class="row gx-5">
                        @php($i = 1)
                        @foreach($data as $elem)
                            <div class="col-md-4 gy-3">
                                <a href="{{ route('manage_course', ['course_id'=>$elem->id]) }}" class="text-center text-decoration-none text-white">
                                    <div class="alert course ">

                                            <h3 class="text-center">{{ $elem->course_name }}</h3>
                                            <h4 class="mt-4">Описание: {{ $elem->course_description }}</h4>


                                    </div>
                                </a>
                            </div>
                            @if($i % 3 == 0)
                                </div><div class="row gx-5">
                            @endif
                            @php($i++)
                        @endforeach
                    </div>
                @else
                    <h3>Вы еще не создали курс </h3>
                @endif
            <a href="{{route('create_course')}}" class="btn btn-login">Создать курс</a>
            </div>
        </div>
    </div>

</div>
@endsection
