@extends('layouts.app_admin')
@section('content')
    <div class="container ">
        <div class="row justify-content">
            <div class="col-md-3">

                    @if ($groups->count() != 0)
                        @php
                            $i = 0;
                        @endphp
                        <table class="table table-text">
                            <thead>
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">Группа</th>
                                <th scope="col">Создание</th>
                                <th scope="col">Изменение</th>
                                <th scope="col">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($groups as $group)
                                @php
                                    $i++;
                                    //dd($group);
                                @endphp
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{ $group->group_name }}</td>
                                <td>{{ $group->created_at }}</td>
                                <td>{{ $group->updated_at }}</td>
                                <td>
                                    <a href="{{route("edit_form", ['group_info'=>$group])}}" class="btn btn-login">Изменить</a>
                                    <a href="" class="btn btn-danger">Удалить</a>
                                </td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>Группы еще не добавлены</h3>
                    @endif

            </div>
        </div>
        <a href="" class="btn btn-login mb-0">Добавить группу</a>
    </div>
@endsection
