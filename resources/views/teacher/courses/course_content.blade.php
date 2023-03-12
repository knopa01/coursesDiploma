@extends('layouts.app')
@section('content')

@if ($data)
    @foreach ($data as $elem)
        <div class="alert alert-info">
            <div>
                <a href="{{ route('manage_content', ['course_id'=>$course_id, 'content_id'=>$elem->id]) }}">
                    <h3>{{ $elem->name }}</h3>

                </a>
            </div>

        </div>
    @endforeach
@endif
<div class="btn">
    <a href="{{ route('create_content', ['course_id'=>$course_id]) }}">Создать лекцию/задачу</a>

</div>
@endsection
