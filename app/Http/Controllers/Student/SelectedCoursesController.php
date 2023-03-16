<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function search_course()
    {
        $data = null;
        return view('student.add_course');
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
                    "course" => $course,
                    "teacher" =>  User::where('id', '=', $course->user_id)->get()[0]->name
                ];
                $i++;
            }
        }
        return view('student.find_course', compact('data'));
    }
    public function course_info() {
        $course_id = request()->course_id;
        $course = Courses::where('id', '=', $course_id)->get();
        $data = [
            "course" => $course[0],
            "teacher" =>  User::where('id', '=', $course[0]->user_id)->get()[0]->name
        ];
        return view('student.course_info', compact('data'));
    }
    public function add_course() {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $course_id = request()->course_id;

        DB::table('student_courses')->insert([
            array(
                'user_id' => $user_id,
                'course_id' => $course_id,
            )
        ]);
        $data = $user->student_courses;
        return view('student.index', compact('data'));


    }
}
