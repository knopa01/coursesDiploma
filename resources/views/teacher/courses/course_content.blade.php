@extends('layouts.app')
@section('content')
@if ($data)
    @foreach ($data as $elem)
        <div class="alert alert-info">
            <div>
                <h3>{{ $elem->name }}</h3>
                <h3>{{ $elem->description }}</h3>
            </div>
        </div>
    @endforeach
@endif
@endsection
