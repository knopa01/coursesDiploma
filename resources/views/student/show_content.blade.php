@extends('layouts.app')
@section('content')

<div class="container ">
    @if (count($contents) != 0)

    @php
        $i = 0;
        $current_task_done = false;
    @endphp
        @foreach ($contents as $content)
            @if ($content->type_of_content == "task")
                @php
                    foreach($student_tasks as $student_task) {
                        if ($student_task->content_id == $content->id) {

                            if ($student_task->done_date != null) {
                                $current_task_done = true;
                            }
                        }
                    }
                @endphp
            @endif
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="position-relative">

                                @if($content->type_of_content == "task")
                                    @if($current_task_done == true)
                                        <div class="card-header position-relative " style="background-color: #8FB92A; height: 50px">
                                            <a href="{{route("home")}}" class="position-absolute top-50 start-0 translate-middle-y" >
                                                <img src="/images/back.png" height="20" class="img-back w-100">
                                            </a>
                                                <h4  class=" position-absolute top-50 start-0 translate-middle-y" style="margin-left: 30px; padding-top: 5px">Задача
                                                    "{{$content->content_name}}"
                                                </h4>
                                            <img src="/images/verified.png" height="25" style="margin-right: 10px" class="position-absolute top-50 end-0 translate-middle-y ">

                                        </div>
                                    @else
                                    <div class="card-header position-relative" style=" height: 50px">
                                        <a href="{{route("home")}}" class="position-absolute top-50 start-0 translate-middle-y" >
                                            <img src="/images/back.png" height="20" class="img-back w-100">
                                        </a>
                                        <h4  class=" position-absolute top-50 start-0 translate-middle-y" style="margin-left: 30px; padding-top: 5px">Задача
                                            "{{$content->content_name}}"
                                        </h4>
                                    </div>
                                    @endif
                                @elseif($content->type_of_content == "lecture")
                                <div class="card-header position-relative" style=" height: 50px">
                                    <a href="{{route("home")}}" class="position-absolute top-50 start-0 translate-middle-y" >
                                        <img src="/images/back.png" height="20" class="img-back w-100">
                                    </a>
                                    <h4  class=" position-absolute top-50 start-0 translate-middle-y" style="margin-left: 30px; padding-top: 5px">Теория
                                        "{{$content->content_name}}"
                                    </h4>
                                </div>
                                @endif

                                <div class="pagination mt-2 ms-2">
                                    {{ $contents->appends(request()->except('page'))->links() }}
                                </div>
                            </div>


                            <div class="card-body ">
                                {{--
                                <ul>
                                    @foreach ($navbar as $n)
                                        <li><a href="#" class="links">{{$n->content_name}}</a></li>
                                    @endforeach
                                </ul>
                                --}}

                                <div class="alert ">
                                    <h3>{{$content->content_name}}</h3>
                                    <pre>{!! $content->content_description !!}</pre>
                                    {{--
                                    <textarea id="content_description" class="loginInputs form-control" readonly>{!! $content->content_description !!}</textarea>
                                    <script>
                                        // Turn off automatic editor creation first.
                                        //CKEDITOR.disableAutoInline = false;

                                        CKEDITOR.inline( 'content_description' );
                                        //CKEDITOR.replace( 'content_description' );
                                        CKEDITOR.replace('content_description');
                                        //CKEDITOR.instances.content_description.config.readOnly = true;

                                    </script>
                                    --}}



                                    {{--CKEDITOR--}}
                                    <script type="text/javascript">
                                        CKEDITOR.instances["content_description"].setHtml( "<?php $content->content_description?>" );
                                    </script>

                                    {{--
                                    echo($student_tasks);

                                        foreach($student_tasks as $student_task)

                                            if ($student_task->content_id == $content->id) {

                                                if ($student_task->done_date != null) {
                                                    $current_task_done = true;
                                                }
                                            }
                                    --}}

                                    @if($content->type_of_content == "task")
                                        @if($current_task_done == false)
                                            <form method="POST" action="{{ route('test_code', ['course_id'=>$content->course_id]) }}">
                                                @csrf

                                                    <label for="source_code" class=" col-form-label text-md-end">Введите код:</label>
                                                    <div class="form-group col-md-10">

                                                        <textarea id="source_code" class="form-control loginInputs" spellcheck="false" name="source_code">{{old('source_code')}}</textarea>
                                                    </div>
                                                    <label for="result" class=" col-form-label text-md-end">Результат:</label>
                                                    <div class="form-group col-md-10">

                                                        <textarea id="result" spellcheck="false" class="form-control loginInputs" name="result">{!! \Session::get('msg') !!}</textarea>
                                                    </div>

                                                    <script>
                                                        var input = document.getElementById("result").value;
                                                        //alert(input);
                                                        if (input == "Задание выполнено верно!") {
                                                            document.getElementById("submit").disabled = true;
                                                        }

                                                    </script>
                                                <br>

                                                <button id="submit" type="submit" class="btn btn-login ">Проверить</button>

                                                <input id="content_id" type="hidden" class="form-control" name="content_id" value={{$content->id}}>
                                                <input id="course_id" type="hidden" class="form-control" name="course_id" value={{$content->course_id}}>
                                            </form>

                                        @else
                                            <h3>Задача решена!</h3>
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endforeach
@else
    <h3 class="mt-2">Преподаватель еще не добавил заданий :(</h3>
@endif
@php
    $i = 0;
    $current_task_done = false;
@endphp
@endsection
