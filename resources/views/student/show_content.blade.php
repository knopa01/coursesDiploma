@extends('layouts.app')
@section('content')

<div class="container ">
    @if (count($navbar) != 0 && count($contents) != 0)
    <div class="row justify-content-left">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Содержание:') }}</div>
                <div class="card-body ">
                    <ul>
                        @foreach ($navbar as $n)
                            <li><a href="#" class="links">{{$n->content_name}}</a></li>
                        @endforeach
                    </ul>
                    @php
                        $i = 0;
                        $current_task_done = false;
                    @endphp
                    @foreach ($contents as $content)
                        <div class="alert card">
                            <p>{{$content->content_name}}</p>
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

                                        <label for="source_code" class=" col-form-label text-md-end">Введите код:</label>
                                        <div class="form-group col-md-10">

                                            <textarea id="source_code" class="form-control loginInputs" name="source_code">{{old('source_code')}}</textarea>
                                        </div>
                                        <label for="result" class=" col-form-label text-md-end">Результат:</label>
                                        <div class="form-group col-md-10">

                                            <textarea id="result" class="form-control loginInputs" name="result">{!! \Session::get('msg') !!}</textarea>
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


                    @endforeach
                    @php
                        $i = 0;
                        $current_task_done = false;
                    @endphp
                    <div class="pagination pagination-lg">
                        {{ $contents->appends(request()->except('page'))->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    @else
        <p>Преподаватель еще не добавил заданий :(</p>
    @endif
</div>
@endsection
