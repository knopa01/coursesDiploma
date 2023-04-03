@extends('layouts.app')
@section('content')
@if (count($navbar) != 0 && count($contents) != 0)

    <ul>
        @foreach ($navbar as $n)
            <li><a href="#">{{$n->content_name}}</a></li>
        @endforeach
    </ul>






    @php
        $i = 0;
        $current_task_done = false;
    @endphp
    @foreach ($contents as $content)
        <div class="alert alert-info">
            <p>{{$content->content_name}}</p>

           <textarea readonly>{{$content->content_description}}</textarea>
            <script>
                // Turn off automatic editor creation first.
                CKEDITOR.disableAutoInline = false;
                CKEDITOR.inline( 'editor1' );
            </script>


            {{--CKEDITOR--}}
            <script type="text/javascript">
                CKEDITOR.instances["content_description"].setHtml( '<b>Inner</b> HTML' );
            </script>
        </div>
        @if ($content->type_of_content == "task")
            @php
            //dd($student_tasks);
            //echo($student_tasks);
                foreach($student_tasks as $student_task)

                    if ($student_task->content_id == $content->id) {

                        if ($student_task->done_date != null) {
                            $current_task_done = true;
                        }
                    }
            @endphp


            @if($current_task_done == false)
                <form method="POST" action="{{ route('test_code', ['course_id'=>$content->course_id]) }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <textarea id="source_code" class="form-control" name="source_code">{{old('source_code')}}</textarea>
                        </div>
                        <div class="form-group col-md-10">
                            <textarea id="result" class="form-control" name="result">{!! \Session::get('msg') !!}</textarea>
                        </div>

                        <div class="form-group col-md-2">
                            <button id="submit" type="submit" class="btn btn-primary btn-block">Проверить</button>
                        </div>

                        <script>
                            var input = document.getElementById("result").value;
                            //alert(input);
                            if (input == "Задание выполнено верно!") {
                                document.getElementById("submit").disabled = true;
                            }

                        </script>




                    </div>
                    <input id="content_id" type="hidden" class="form-control" name="content_id" value={{$content->id}}>
                    <input id="course_id" type="hidden" class="form-control" name="course_id" value={{$content->course_id}}>
                </form>

            @else

                <h1>Задача решена!</h1>

            @endif


        @endif

    @endforeach
    @php
        $i = 0;
        $current_task_done = false;
    @endphp

    {{ $contents->appends(request()->except('page'))->links() }}






@else
    <p>Преподаватель еще не добавил заданий :(</p>
@endif

@endsection
