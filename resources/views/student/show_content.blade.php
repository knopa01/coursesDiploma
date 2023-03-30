@extends('layouts.app')
@section('content')
@if (count($navbar) != 0 && count($contents) != 0)
    <ul>
        @foreach ($navbar as $n)
            <li><a href="#">{{$n->name}}</a></li>
        @endforeach
    </ul>
    @foreach ($contents as $content)
        <div class="alert alert-info">
            <p>{{$content->name}}</p>


            <div id="editor1" contenteditable="true">
                <p>The "div" element that contains this text is now editable.</p>
                <pre id="content_description">{{$content->description}}</pre>

            </div>
            <script>
                // Turn off automatic editor creation first.
                CKEDITOR.disableAutoInline = true;
                CKEDITOR.inline( 'editor1' );
            </script>


            {{--CKEDITOR--}}
            <script type="text/javascript">
                CKEDITOR.instances["content_description"].setHtml( '<b>Inner</b> HTML' );
            </script>
        </div>
        @if ($content->type_of_content == "task")
            <form method="POST" action="{{ route('test_code', ['course_id'=>$content->course_id]) }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <textarea id="source_code" class="form-control" name="source_code"></textarea>
                    </div>
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-primary btn-block">Проверить</button>
                    </div>
                </div>
                <input id="content_id" type="hidden" class="form-control" name="content_id" value={{$content->id}}>
                <input id="course_id" type="hidden" class="form-control" name="course_id" value={{$content->course_id}}>
            </form>
        @endif
    @endforeach


    {{ $contents->links() }}


@else
    <p>Преподаватель еще не добавил заданий :(</p>
@endif

@endsection
