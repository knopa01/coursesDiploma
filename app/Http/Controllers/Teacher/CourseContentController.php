<?php

namespace App\Http\Controllers\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CoursePlan;
use App\Models\Courses;
use App\Models\User;
class CourseContentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index($course_id)
    {
        //$user = User::find(Auth::id());
        //$courses = Courses::where('user_id', $user);
        //$courses = Courses::all();
        //dd($user->courses);

        //dd($course_id);
        //$course_id = $courses->id;
        $course_plan = CoursePlan::where('course_id', '=', $course_id)->get();
        //$courses = Courses::where('user_id', $user);
        //$courses = Courses::all();
        $data = $course_plan[0]->lectures; //ТУТ ОШИБКА


        //return view("teacher.courses.index", ['data' => $user->courses]);
        return view("teacher.courses.course_content", ['data' => $data]);


    }
    public function create_course()
    {
        $user_id = Auth::id();
        $course_name = request()->course_name;
        $course_description = request()->course_description;
        DB::table('courses')->insert([
            array(
                'user_id' => $user_id,
                'course_name' => $course_name,
                'course_description' => $course_description
            )
        ]);
        $message = "Данные успешно добавлены!";
        return view("teacher.courses.done", compact('message'));
    }


}

