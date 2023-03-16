@extends('layouts.app')
@section('content')
<form action="{{ route('find_course')}}">
    <div class="form-row">
        <div class="form-group col-md-10">
            <input type="text" class="form-control" id="search" name="name">
        </div>
        <div class="form-group col-md-2">
            <button type="submit" class="btn btn-primary btn-block">Найти</button>
        </div>
    </div>

</form>
@endsection
