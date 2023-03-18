@extends('layouts.app')
@section('content')
<p>{{$course_name}}</p>
<p>{{$content->name}}</p>
<a href="#">Вперед</a>
<a href="#">Назад</a>
@endsection
