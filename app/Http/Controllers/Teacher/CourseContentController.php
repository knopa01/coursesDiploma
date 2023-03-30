<?php

namespace App\Http\Controllers\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CoursePlan;
use App\Models\Courses;
use App\Models\Content;
use App\Models\Language;
use App\Models\Test;
use App\Models\User;
class CourseContentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index($course_id)
    {
        $course_data = Courses::where('id', '=', $course_id)->get();
        $data = null;
        $course = null;
        $languages = Language::all();
        $selected_language = null;
        if($course_data->count() != 0) {
            $selected_language = Language::find($course_data[0]->language_id);
            $data = $course_data[0]->contents->sortBy('sort');
            //dd($data);
            $course = $course_data[0];

        }

        //return view("teacher.courses.index", ['data' => $user->courses]);
        return view("teacher.courses.course_content", ['data' => $data, 'course'=>$course ,'course_id' => $course_id, 'languages'=> $languages , 'selected_language' => $selected_language]);
    }


    public function edit_course() {
        $validatedData = request()->validate([

            'course_name' => ['required'],
            'language_id' => ['required'],
            'course_description' => ['required']
        ]);

        $course_id = request()->course_id;
        $course_name = request()->course_name;
        $language_id = request()->language_id;
        $course_description = request()->course_description;
        $data = Courses::where('id', '=', $course_id)->get();


        if ($data[0]->course_name != $course_name || $data[0]->course_description != $course_description || $data[0]->language_id != $language_id) {
            $course = Courses::find($course_id);
            $course->course_name = $course_name;
            $course->course_description = $course_description;
            $course->language_id = $language_id;
            $course->save();
            /*
            Courses::where('id', $course_id)->update(array(
                'course_name'=>$course_name,
                'language_id'=>$language_id,
                'course_description'=>$course_description
            ));
            */
            $ctrl = "content";
            $message = "Данные успешно обновлены!";
            return view("teacher.courses.done", ['message'=>$message,'ctrl'=>$ctrl, 'course_id'=>$course_id, 'content_id'=>null]);
        } else {
            return redirect()->route('manage_course', ['course_id'=>$course_id]);
        }
    }


    public function show_form() {
        $course_id = request()->course_id;

        return view("teacher.courses.create_content", ['course_id'=>$course_id]);
    }


    public function show_content($course_id, $content_id) {

        $data = Content::where('id', '=', $content_id)->get();
        //dd($data);

        $tests = null;

        if($data[0]->type_of_content == "task") {
            $tests = Test::where('content_id', '=', $content_id)->get();
        }
        return view("teacher.courses.edit_course_content", ['data' => $data, 'tests'=> $tests, 'course_id' => $course_id]);
    }


    public function show_test($course_id, $content_id, $test_id) {

        $data = Test::where('id', '=', $test_id)->get();
        return view("teacher.courses.edit_test", ['data' => $data, 'content_id'=>$content_id, 'course_id' => $course_id]);
    }


    public function edit_content() {
        //dd(request());
        $validatedData = request()->validate([

            'content_name' => ['required'],
            'content_description' => ['required'],
            'sort' => ['required'],
            'sort' => function($attribute, $value, $fail) {
                $course_id = request()->course_id;
                $all_content = Content::where('course_id', $course_id)->get();
                foreach($all_content as $i) {
                    if ($i->sort == request()->sort && $i->id != request()->content_id) {
                        //dd("Уже было");
                        $fail('Данный порядковый номер '.$i.' уже существует!');

                    }
                }
            }


        ]);
        $course_id = request()->course_id;
        //$all_content = Content::where('course_id', $course_id)->get();
        $sort = request()->sort;

        $content_id = request()->content_id;

        $content_name = request()->content_name;
        $content_type = request()->content_type;
        $content_description = request()->content_description;

        $data = Content::where('id', $content_id)->get();
        //dd($data);

        if ($data[0]->content_name != $content_name || $data[0]->sort != $sort ||$data[0]->content_description != $content_description) {
            /*
            Content::where('id', $content_id)->update(array(
                'name'=>$content_name,
                'description'=>$content_description
            ));
            */
            $content = Content::find($content_id);
            $content->content_name = $content_name;
            $content->type_of_content = $content_type;
            $content->content_description = $content_description;
            $content->sort = $sort;
            $content->save();
            $ctrl = "content";
            $message = "Данные успешно обновлены!";
            return view("teacher.courses.done", ['message'=>$message,'ctrl'=>$ctrl, 'course_id'=>$course_id, 'content_id'=>null]);
        } else {
            return redirect()->route('manage_course', ['course_id'=>$course_id]);
        }
    }


    public function edit_test() {
        $content_id = request()->content_id;
        $test_id = request()->test_id;
        $test_input = request()->test_input;
        $test_output = request()->test_output;
        $data = Test::where('id', '=', $test_id)->get();
        $course_id = request()->course_id;
        if ($data[0]->test_input != $test_input || $data[0]->test_output != $test_output) {
            Test::where('id', $test_id)->update(array(
                'test_input'=>$test_input,
                'test_output'=>$test_output
            ));
            $ctrl = "test";
            $message = "Данные успешно обновлены!";
            return view("teacher.courses.done", ['message'=>$message,'ctrl'=>$ctrl, 'course_id'=>$course_id, 'content_id'=>$content_id]);
        } else {
            return redirect()->route('manage_content', ['course_id'=>$course_id, 'content_id'=>$content_id]);
        }
    }


    public function create_content() {
        $validatedData = request()->validate([

            'content_name' => ['required'],
            'content_type' => ['required'],
            'content_description' => ['required'],
            'content_sort' => ['required'],
            'content_sort' => function($attribute, $value, $fail) {
                    $course_id = request()->course_id;
                    $all_content = Content::where('course_id', $course_id)->get();
                    foreach($all_content as $i) {
                        if ($i->sort == request()->content_sort && $i->id != request()->content_id) {
                            //dd("Уже было");
                            $fail('Данный порядковый номер '.$i.' уже существует!');

                        }
                    }
                }
        ]);


        $course_id = request()->course_id;
        $content = new Content();
        $content->content_name = request()->content_name;
        $content->type_of_content = request()->content_type;
        $content->content_description = request()->content_description;
        $content->sort = request()->content_sort;
        $content->course_id = $course_id;
        $content->save();

        /*
        $content_name = request()->content_name;
        $content_type = request()->content_type;
        $content_description = request()->content_description;
        $content_sort = request()->content_sort;
        $course_id = request()->course_id;
        DB::table('contents')->insert([
            array(
                'type_of_content' => $content_type,
                'content_name' => $content_name,
                'content_description'=> $content_description,
                'sort' => $content_sort,
                'course_id' => $course_id
            )
        ]);
        */
        $message = "Данные успешно добавлены!";
        $ctrl="content";
        return view("teacher.courses.done", ['message'=>$message,'ctrl'=>$ctrl, 'course_id'=>$course_id, 'content_id'=>null]);
    }


    public function create_test_form() {
        $content_id = request()->content_id;
        $course_id = request()->course_id;
        return view("teacher.courses.create_test", ['course_id'=>$course_id, 'content_id'=>$content_id]);
    }
    public function create_test() {

        $test_input = request()->test_input;
        $test_output = request()->test_output;
        $course_id = request()->course_id;
        $content_id = request()->content_id;

        DB::table('tests')->insert([
            array(
                'test_input' => $test_input,
                'test_output' => $test_output,
                'content_id'=> $content_id,
            )
        ]);
        $ctrl = "test";
        $message = "Данные успешно добавлены!";
        return view("teacher.courses.done", ['message'=>$message,'ctrl'=>$ctrl, 'course_id'=>$course_id, 'content_id'=>$content_id]);
    }

    public function delete_test() {
        $test_id = request()->test_id;
        $test = Test::find($test_id);
        $content_id = $test->content_id;
        $course_id = Content::find($content_id)->course_id;

        if ($test) {
            $test->delete();
        }
        $message = "Тест удален";
        $ctrl = "test";
        return view("teacher.courses.done", ['message'=>$message,'ctrl'=>$ctrl, 'course_id'=>$course_id, 'content_id'=>$content_id]);

    }
    public function delete_content() {
        $content_id = request()->content_id;
        $content = Content::find($content_id);
        $course_id = $content->course_id;
        if ($content) {
            $content->delete();
        }
        $message = "Задача удалена";
        if($content->type_of_content == "lecture") {
            $message = "Теория удалена";
        }

        $ctrl = "content";
        return view("teacher.courses.done", ['message'=>$message,'ctrl'=>$ctrl, 'course_id'=>$course_id, 'content_id'=>null]);
    }



}

