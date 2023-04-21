@extends('layouts.app_admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Редактировать группу') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('edit_group')}}">
                            @csrf

                            <div class="row mb-3">
                                <label for="group_name" class="col-md-4 col-form-label text-md-end">Название группы</label>

                                <div class="col-md-6">
                                    <input id="group_name" type="text" class=" loginInputs form-control @error('group_name') is-invalid @enderror"  name="group_name" value="{{$group_info->group_name}}" >
                                    <input id="group_id" type="hidden" class=" loginInputs form-control"  name="group_id" value="{{$group_info->id}}" >
                                   {{--
                                    @error('course_name.required')
                                    <div class="alert alert-danger"> Необходимо заполнить это поле!</div>
                                    @enderror

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    --}}
                                    @error('group_name')

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
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
