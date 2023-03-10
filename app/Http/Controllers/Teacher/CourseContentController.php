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
use App\Models\User;
class CourseContentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index($course_id)
    {
        $course_plan = Courses::where('id', '=', $course_id)->get();
        $data = null;

        if($course_plan->count() != 0) {

            $data = $course_plan[0]->contents->sortBy('sort');
        }
        //return view("teacher.courses.index", ['data' => $user->courses]);
        return view("teacher.courses.course_content", ['data' => $data, 'course_id' => $course_id]);
    }

    public function show_content($course_id, $content_id) {

        $data = Content::where('id', '=', $content_id)->get();
        //dd($data);

        return view("teacher.courses.edit_course_content", ['data' => $data, 'course_id' => $course_id]);
    }

    public function edit_content() {

        $content_id = request()->content_id;
        $content_name = request()->content_name;
        $content_type = request()->content_type;
        $content_description = request()->content_description;


        Content::where('id', $content_id)->update(array(
            'name'=>$content_name,
            'description'=>$content_description
        ));
        $message = "Данные успешно добавлены!";
        return view("teacher.courses.done", compact('message'));
    }

    public function show_form() {
        $course_id = request()->course_id;
        return view("teacher.courses.create_content", ['course_id'=>$course_id]);
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
        return view("teacher.courses.done", compact('message'));
    }



}

