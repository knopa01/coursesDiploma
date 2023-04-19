@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Регистрация') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('myregister') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('ФИО') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="loginInputs form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" >
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="loginInputs form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <select id="usertype" name="usertype" class="loginInputs">
                                    @php
                                        //тут надо менять
                                            $show = "";
                                            if(old('usertype') == "student") {
                                                $show = "студентом";
                                            } else if(old('usertype') == "teacher") {
                                                $show = "преподавателем";
                                            } else {
                                                $show = "Выберете значение";
                                            }
                                    @endphp
                                    <option selected>{{$show}}</option>
                                    <option value="student">студентом</option>
                                    <option value="teacher">преподавателем</option>

                                </select>
                            </div>
                            <div class="row mb-3" id="userGroup">
                                <label for="usergroup" class="col-md-4 col-form-label text-md-end">{{ __('Ваша группа:') }}</label>
                                <div class="col-md-6">

                                    <select id="usergroup" name="usergroup" class="loginInputs @error('usergroup') is-invalid @enderror" >
                                        <option selected>Выберите значение</option>
                                        <option selected>{{old('usergroup')}}</option>
                                        @foreach($groups as $group)


                                            <option value="{{$group->id}}">{{$group->group_name}}</option>

                                        @endforeach

                                    </select>
                                    @error('usergroup')
                                    <div class="alert alert-danger"> Выберете группу!</div>
                                    @enderror
                                </div>
                            </div>
                            <script>
                                document.getElementById("userGroup").hidden = true;
                                alert(document.getElementById('usertype').value == "student")
                                if(document.getElementById('usertype').value == "student") {
                                    document.getElementById("userGroup").hidden = false;
                                } else {
                                    document.getElementById("userGroup").hidden = true;
                                }
                                /*
                                document.getElementById('usertype').addEventListener('change', function() {
                                    const n = this.value;
                                    //console.log(n)

                                    if(n == "student"){
                                        document.getElementById("userGroup").hidden = false;
                                    } else {
                                        document.getElementById("userGroup").hidden = true;
                                    }

                                }) */




                            </script>


                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="loginInputs form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                                <input id="password-confirm" type="password" class="loginInputs form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn-login btn ">
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
