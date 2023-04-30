@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content">
        <div class="col-12">
            <div class="card">
                <div class="position-relative">
                    <div class="card-header ms-4">Добавить курс
                        <a href="{{route("home")}}" class="position-absolute top-2 start-0 ms-3" >
                            <img src="/images/back.png" height="20" class="img-back">
                        </a>
                    </div>
                </div>
                <div class="card-body course">
                    <form method="POST" class="ms-2" action="{{ route('find_course')}}">
                        @csrf
                        <div class="course">
                            <label for="name" class="col-12 col-form-label">{{ __('Название курса:') }}</label>
                            <div class="row mb-3">
                                <input type="text" class="input_size col-12 col-sm-4 me-1 size_input " id="search" name="name">
                                <button type="submit" style="width: 10vw; min-width: 100px " class="col-2 button_size btn btn-login">Найти</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if($message != null)
<script>
    alert("Вы уже изучаете данный курс!");
</script>
@endif
@endsection
