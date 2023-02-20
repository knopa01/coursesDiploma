@extends('layouts.app')
@section('content')
я учитель

@foreach ($data as $elem)
    <div class="alert alert-info">
        <h3>{{ $elem->course_name }}</h3>
        <h3>{{ $elem->course_description }}</h3>
    </div>
@endforeach
<div class="btn">
    <a href="/home/create-course">Создать курс</a>
</div>
@endsection
