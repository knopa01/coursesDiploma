@extends('layouts.app')
@section('content')

<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if($msg != "")
                <script>
                    alert("<?= $msg?>")
                </script>

            @endif
            <div class="card">

                <div class="position-relative">
                    <div class="card-header ms-4">Доступные курсы
                        <a href="{{route("home")}}" class="position-absolute top-2 start-0 ms-3" >
                            <img src="/images/back.png" height="20" class="img-back">
                        </a>
                    </div>
                </div>
                <div class="card-body ">
                    <form method="POST" class="ms-2" action="{{ route('find_course')}}">
                        @csrf
                        <label for="name" class="col-12 col-form-label">{{ __('Название курса:') }}</label>
                        <div class="row mb-3">
                            <input type="text" class="input_size col-12 col-sm-4 me-1 size_input loginInputs" id="search" name="name">
                            <button type="submit" style="width: 10vw; min-width: 100px " class="col-2 button_size btn btn-login">Найти</button>
                        </div>
                    </form>
                    @if ($data)
                        <div class="row gx-5">
                            @php($i = 1)
                            @foreach ($data as $d)
                                <div class="col-md-4 gy-3">
                                    <a href="{{ route('course_info', ['course_id'=>$d["course"]->id])}}" class="text-center text-decoration-none text-white">
                                        <div class="alert course ">
                                            <h3>{{ $d["course"]->course_name }}</h3>
                                            <h3>Преподаватель: {{ $d["teacher"] }}</h3>
                                        </div>

                                    </a>
                                </div>
                                @if($i % 3 == 0)
                                </div><div class="row gx-5">
                                @php($i++)
                                @endif

                            @endforeach
                        </div>


                    @endif

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
