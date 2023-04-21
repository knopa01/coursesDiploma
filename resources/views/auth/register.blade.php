@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Регистрация') }}</div>

                <div class="card-body">
                    <form id="form" method="POST" action="{{ route('myregister') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('ФИО') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="loginInputs form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"   autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" >
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="loginInputs form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3" >
                            <label for="usertype" class="col-md-4 col-form-label text-md-end">{{ __('Вы являетесь') }}</label>
                            <div class="col-md-6">
                                    <select id="usertype" name="usertype" class="select-style  @error('usertype') is-invalid @enderror" >


                                        //тут надо менять

                                            @if(old('usertype') == "student") {

                                                <option value="student" selected>Студентом</option>
                                                <option value="teacher">Преподавателем</option>
                                            } @elseif(old('usertype') == "teacher") {
                                                <option value="student" >Студентом</option>
                                                <option value="teacher" selected>Преподавателем</option>
                                            } @else {
                                                <option selected >Выберите значение</option>
                                                <option value="student" >Студентом</option>
                                                <option value="teacher" >Преподавателем</option>
                                            }
                                            @endif





                                </select>
                                @error('usertype')
                                    <span class="invalid-feedback" role="alert">
                                        {{--<div class="text-danger" style="font-size: .875em;"> <strong>Выберете группу!</strong> </div>--}}
                                        <strong>{{$message}}</strong>
                                    </span>


                                @enderror

                            </div>
                        </div>
                        <div class="row mb-3" id="userGroup" hidden>
                            <label for="usergroup" class="col-md-4 col-form-label text-md-end">{{ __('Ваша группа:') }}</label>
                            <div class="col-md-6">

                                <select id="usergroup" name="usergroup" class="select-style @error('usergroup') is-invalid @enderror" >
                                    <option selected>Выберите значение</option>

                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->group_name}}</option>

                                    @endforeach

                                </select>
                                @error('usergroup')

                                    <span class="invalid-feedback" role="alert">
                                    {{--<div class="text-danger" style="font-size: .875em;"> <strong>Выберете группу!</strong> </div>--}}
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <script>
                                //document.getElementById("usergroup").hidden = true;
                                /*
                                document.getElementById("userGroup").hidden = true;
                                console.log(document.getElementById('usertype').value)
                                if(document.getElementById('usertype').value == "student") {
                                    document.getElementById("userGroup").hidden = false;
                                } else {
                                    document.getElementById("userGroup").hidden = true;
                                }
                                */
                                document.addEventListener('DOMContentLoaded', function() {
                                    const n = document.getElementById("usertype").value;
                                    //console.log(n)

                                    if(n == "student"){
                                        document.getElementById("userGroup").hidden = false;
                                        console.log("true")
                                    } else {
                                        document.getElementById("userGroup").hidden = true;
                                        console.log("false")
                                    }

                                })
                                document.getElementById('usertype').addEventListener('change', function() {
                                    const n = this.value;
                                    //console.log(n)

                                    if(n == "student"){
                                        document.getElementById("userGroup").hidden = false;
                                        console.log("true")
                                    } else {
                                        document.getElementById("userGroup").hidden = true;
                                        console.log("false")
                                    }

                                })
                                /*
                                document.getElementById('submit1').addEventListener('click', function() {
                                    const n = this.value;
                                    console.log(n)

                                    if(n == "student"){
                                        document.getElementById("userGroup").hidden = false;
                                        console.log("true")
                                    } else {
                                        document.getElementById("userGroup").hidden = true;
                                        console.log("false")
                                    }

                                })
                                */





                            </script>



                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="loginInputs form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Повторите пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="loginInputs form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="submit1" type="submit" class="btn-login btn ">
                                    {{ __('Регистрация') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
