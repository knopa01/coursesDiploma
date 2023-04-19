@extends('layouts.app_admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Добавить группу') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('create_group') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="group_name" class="col-md-4 col-form-label text-md-end">Название группы</label>
                                <div class="col-md-6">
                                    <input id="group_name" type="text" class=" loginInputs form-control @error('group_name') is-invalid @enderror" name="group_name" value="{{old('group_name')}}" >

                                    @error('group_name')
                                    <div class="alert alert-danger"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-save">
                                        Сохранить
                                    </button>
                                    <a href="{{route("admin_groups")}}" class="btn btn-danger mb-0">Отмена</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
