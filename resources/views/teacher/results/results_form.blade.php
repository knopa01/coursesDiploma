@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content">
        <div class="col-12">
            <div class="card">
                <div class="position-relative">
                    <div class="card-header ms-4">Результаты обучения
                        <a href="{{route("study_results")}}" class="position-absolute top-2 start-0 ms-3" >
                            <img src="/images/back.png" height="20" class="img-back">
                        </a>
                    </div>
                    <div class="card-body ">
                        <div class="alert ">
                            <div class="alert">
                                <form method="POST" class="mt-2 ms-2" action="{{ route('find_student')}}">
                                    @csrf
                                    <label for="name" class="col-12 col-form-label">{{ __('Имя студента:') }}</label>
                                    <div class="row mb-3">
                                        <input type="text"  class="input_size col-12 col-sm-4 me-1 size_input loginInputs" id="name" name="name">
                                        <input type="hidden"  id="course_id" name="course_id" value={{$course_id}}>
                                        <button type="submit" style="width: 10vw; min-width: 100px " class="col-2 button_size btn btn-login">Найти</button>
                                    </div>
                                </form>
                                @if(count($groups) != 0)
                                    <form method="POST" action="{{route('group_results')}}">
                                        @csrf

                                            <div class="row mb-3">
                                                <label for="group_id" class="col-12 col-form-label ">{{ __('Выберите группу:') }}</label>
                                                <div class="col-md-auto">
                                                    <select id="group_id" name="group_id" class="size_select select-style @error('group_id') is-invalid @enderror" >
                                                        <option selected>Выберите значение</option>
                                                        @foreach($groups as $group)
                                                            <option value="{{$group->id}}">{{$group->group_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('group_id')

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </span>
                                                    @enderror
                                                    <input type="hidden" class="form-control" id="course_id" name="course_id" value={{$course_id}}>
                                                    <button type="submit"  class="button_size btn btn-login">Найти</button>
                                                </div>

                                            </div>

                                    </form>
                                @else
                                    <h3>Список групп пуст.</h3>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>





    </div>
</div>
@endsection
