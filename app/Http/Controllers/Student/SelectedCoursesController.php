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
        $courses = null;
        $teachers = null;
        return view('student.add_course', compact('courses', 'teachers'));
    }
    public function find_course(Request $request)
    {
        $name = $request->name;

        $courses = Courses::where('course_name', 'LIKE', "%{$name}%")->get();
        $teachers = [];
        if ($courses)
        {
            $i = 0;
            foreach ($courses as $course)
            {
                $teachers[$i] =  User::where('id', '=', $course->user_id)->get()[0]->name;
                $i++;

            }


        }

        return view('student.add_course', compact('courses', 'teachers'));
    }
}
