@extends('layouts.app')
@section('content')
    @foreach ($contents as $content)
        <div class="alert alert-info">
            <p>{{$content->name}}</p>
            <p>{{$content->description}}</p>
        </div>
        @endforeach
        {{ $contents->links() }}
@endsection
