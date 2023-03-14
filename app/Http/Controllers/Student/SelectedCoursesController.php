<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Courses;

class SelectedCoursesController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        $data = $user->student_courses;
        return view('student.index', compact('data'));
    }
    public function add_course()
    {
        $data = null;
        return view('student.add_course', compact('data'));
    }
    public function find_course(Request $request)
    {
        $name = $request->name;

        $courses = Courses::where('course_name', 'LIKE', "%{$name}%")->get();

        $data = [];
        if ($courses)
        {
            $i = 0;
            foreach ($courses as $course)
            {
                $data[$i] = [
                    "course_name" => $course,
                    "teacher" =>  User::where('id', '=', $course->user_id)->get()[0]->name
                ];
                $i++;

            }
            dd($data[0]["course_name"]->course_name); //Узнать как это вывести



        }

        return view('student.add_course', compact('data'));
    }
}
