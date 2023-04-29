@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Настройки') }}</div>
                @if($msg != null && $msg != "")
                    <script>
                        alert("<?= $msg?>")
                    </script>
                @endif
                <div class="card-body">
                    <form id="form" method="POST" action="{{route('save_settings')}}">
                        @csrf

                        <div class="row mb-3" >
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="loginInputs form-control @error('email') is-invalid @enderror" name="email" value="{{ $user_info->email }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if($user_info->usertype == "student")
                            <div class="row mb-3" id="userGroup" >
                                <label for="usergroup" class="col-md-4 col-form-label text-md-end">{{ __('Ваша группа:') }}</label>
                                <div class="col-md-6">

                                    <select id="usergroup" name="usergroup" class="select-style @error('usergroup') is-invalid @enderror" >
                                        <option selected value="{{$user_info->user_group_id}}">{{$group_name }}</option>

                                        @foreach($groups as $group)
                                            @if($group->id != $user_info->user_group_id)
                                                <option value="{{$group->id}}">{{$group->group_name}}</option>
                                            @endif
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
                        @endif

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Изменить пароль') }}</label>

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
                                    {{ __('Сохранить') }}
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
