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

        if($course_data->count() != 0) {

            $data = $course_data[0]->contents->sortBy('sort');
            $course = $course_data[0];

        }

        //return view("teacher.courses.index", ['data' => $user->courses]);
        return view("teacher.courses.course_content", ['data' => $data, 'course'=>$course ,'course_id' => $course_id]);
    }


    public function edit_course() {
        $course_id = request()->course_id;
        $course_name = request()->course_name;
        $course_description = request()->course_description;
        $data = Courses::where('id', '=', $course_id)->get();

        if ($data[0]->course_name != $course_name || $data[0]->course_description != $course_description) {
            Courses::where('id', $course_id)->update(array(
                'course_name'=>$course_name,
                'course_description'=>$course_description
            ));
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

        $content_id = request()->content_id;
        $content_name = request()->content_name;
        $content_type = request()->content_type;
        $content_description = request()->content_description;
        $course_id = request()->course_id;
        $data = Content::where('id', '=', $content_id)->get();

        if ($data[0]->name != $content_name || $data[0]->description != $content_description) {
            Content::where('id', $content_id)->update(array(
                'name'=>$content_name,
                'description'=>$content_description
            ));
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
        $content_name = request()->content_name;
        $content_type = request()->content_type;
        $content_description = request()->content_description;
        $content_sort = request()->content_sort;
        $course_id = request()->course_id;
        DB::table('contents')->insert([
            array(
                'type_of_content' => $content_type,
                'name' => $content_name,
                'description'=> $content_description,
                'sort' => $content_sort,
                'course_id' => $course_id
            )
        ]);
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
        $message = "Тест удален";
        $ctrl = "content";
        return view("teacher.courses.done", ['message'=>$message,'ctrl'=>$ctrl, 'course_id'=>$course_id, 'content_id'=>null]);
    }


}

