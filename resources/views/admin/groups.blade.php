@extends('layouts.app_admin')
@section('content')
    <div class="container justify-content-center">
        <div class="justify-content-center">
            <div class="col-md-8 offset-md-2" >

                <script type="text/JavaScript">
                        @if ($msg != "")
                        alert('<?=$msg ?>')

                        @endif


                    </script>


                    @if ($groups->count() != 0)
                        @php
                            $i = 0;
                        @endphp
                        <table class="table table align-middle table-text text-center">
                            <thead>
                            <tr >
                                <th scope="col">№</th>
                                <th scope="col">Группа</th>
                                <th scope="col">Создание</th>
                                <th scope="col">Изменение</th>
                                <th scope="col" >Действие</th>
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
                                    <a href="{{route("edit_form", ['group_info'=>$group])}}" class="btnAdmin my-1 btn btn-login">Изменить</a>
                                    <a href="{{route("delete_group", ['group_id'=>$group->id])}}" class="btnAdmin my-1 btn btn-danger">Удалить</a>
                                </td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>Группы еще не добавлены</h3>
                    @endif
                    <a href="{{route("create_form")}}" class="btn btn-save mb-0">Добавить группу</a>
            </div>

        </div>

    </div>
@endsection
