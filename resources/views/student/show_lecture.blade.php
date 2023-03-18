@extends('layouts.app')
@section('content')
<p>{{$course_name}}</p>
<p>{{$content->name}}</p>
{{--<a href="{{route('next',['content_id'=>$content->id])}}">Вперед</a> --}}
{{--<a href="{{redirect()->action([TrainingController::class, 'next'])}}"> Вперед</a> --}}
<a href="#">Вперед</a>
<a href="#">Назад</a>
@endsection
