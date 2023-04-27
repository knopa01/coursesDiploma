@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content">
        <div class="col-md-12">
            <div class="container">
                <h2 >Результат обучения:</h2>
                @if (count($data) != 0)

                        <div class="row gx-5">
                            @php($i = 1)
                            @foreach($data as $elem)
                                <div class="col-md-4 gy-3">
                                    <a href="{{ route('show_study_form', ['course_id'=>$elem->id]) }}" class="text-center text-decoration-none text-white">
                                        <div class="alert course ">
                                            <h3>{{ $elem->course_name }}</h3>
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
            </div>
        </div>
    </div>
</div>
@endsection
