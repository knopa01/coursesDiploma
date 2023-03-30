<?php

namespace App\Http\Controllers\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\User;
use App\Models\Language;
class ManageCourseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function show_form()
    {
        //$user = User::find(Auth::id());
        //$courses = Courses::where('user_id', $user);
        //$courses = Courses::all();
        //dd($user->courses);
        $languages = Language::all();
        //dd($languages);
        return view("teacher.courses.create", compact('languages'));
    }
    public function create_course()
    {
        $validatedData = request()->validate([

            'course_name' => ['required'],
            'language_id' => ['required'],
            'course_description' => ['required']
        ]);
        $course = new Courses();
        $course->user_id = Auth::id();
        $course->course_name = request()->course_name;
        $course->course_description = request()->course_description;
        $course->language_id = request()->language_id;
        $course->save();
        /*
        $user_id = Auth::id();
        $course_name = request()->course_name;
        $language_id = request()->language_id;
        //dd($language_id);
        $course_description = request()->course_description;
        DB::table('courses')->insert([
            array(
                'user_id' => $user_id,
                'course_name' => $course_name,
                'language_id' => $language_id,
                'course_description' => $course_description
            )
        ]);
        */
        $message = "Данные успешно добавлены!";
        $ctrl = "course";
        return view("teacher.courses.done", ['message'=>$message,'ctrl'=>$ctrl, 'course_id'=>null, 'content_id'=>null]);
    }

    public function delete_course() {
        $course_id = request()->course_id;
        $course = Courses::find($course_id);
        $course->delete();
        $message = "Курс удален";
        $ctrl = "course";
        return view("teacher.courses.done", ['message'=>$message,'ctrl'=>$ctrl, 'course_id'=>null, 'content_id'=>null]);
    }

    public function index()
    {
        $user = User::find(Auth::id());
        //$courses = Courses::where('user_id', $user);
        //$courses = Courses::all();
        //dd($user->courses);
        $data = $user->courses;
        //dd($data);
        return view("teacher.courses.index", ['data' => $data]);


    }


}

