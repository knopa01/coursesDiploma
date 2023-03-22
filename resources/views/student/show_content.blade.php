@extends('layouts.app')
@section('content')

<ul>
    @foreach ($navbar as $n)
        <li><a href="#">{{$n->name}}</a></li>
    @endforeach
  </ul>
    @foreach ($contents as $content)
        <div class="alert alert-info">
            <p>{{$content->name}}</p>
            <p>{{$content->description}}</p>
        </div>
        @if ($content->type_of_content == "task")
        <form method="POST" action="">
        <div class="form-row">
            <div class="form-group col-md-10">
                <textarea id="source_code" class="form-control" name="source_code"></textarea>
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary btn-block">Проверить</button>
            </div>
        </div>

    </form>
        @endif
        @endforeach
        {{ $contents->links() }}
        @php
        $paginator->url($page)
        @endphp
@endsection
