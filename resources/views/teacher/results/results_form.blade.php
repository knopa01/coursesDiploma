@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content">
        <form method="POST" action="{{ route('find_student')}}">
            @csrf

                <div class="row mb-3">

                    <h3>Имя студента:</h3>
                    <div class="form-group col-md-10">

                        <input type="text" class="form-control" id="name" name="name">
                        <input type="hidden" class="form-control" id="course_id" name="course_id" value={{$course_id}}>
                        <button type="submit" class="btn btn-primary btn-block">Найти</button>
                    </div>
                </div>
        </form>
        @if(count($groups) != 0)
            <form method="POST" action="{{route('group_results')}}">
                @csrf
                <div class="row mb-3" id="userGroup">
                    <label for="group_id" class="col-md-4 col-form-label text-md-end">{{ __('Выберите группу:') }}</label>
                    <div class="col-md-6">
                        <select id="group_id" name="group_id" class="select-style @error('group_id') is-invalid @enderror" >
                            <option selected>Выберите значение</option>
                            @foreach($groups as $group)
                                <option value="{{$group->id}}">{{$group->group_name}}</option>
                            @endforeach
                        </select>
                        @error('group_id')

                            <span class="invalid-feedback" role="alert">
                                {{--<div class="text-danger" style="font-size: .875em;"> <strong>Выберете группу!</strong> </div>--}}
                                    <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <input type="hidden" class="form-control" id="course_id" name="course_id" value={{$course_id}}>
                <button type="submit" class="btn btn-primary btn-block">Найти</button>
            </form>
        @else
            <h3>Список групп пуст.</h3>
        @endif




    </div>
</div>
@endsection
