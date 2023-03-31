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
        $data = null;
        $courses = $user->student_courses;
        //dd($courses);

        if ($courses->count() != 0) {
            $i = 0;
            foreach ($courses as $course) {
                $course_data = Courses::find($course->course_id);
                //dd($course_data);
                $teacher_id = $course_data->user_id;
                $teacher_name = User::where('id', '=', $teacher_id)->get()[0]->name;
                //echo($teacher_id);
                //echo($teacher_name."\n");
                $data[$i] = [
                    "course_id" =>$course_data->id,
                    "course_name" => $course_data->course_name,
                    "course_description" => $course_data->course_description,
                    "teacher" =>$teacher_name
                    //"teacher" =>  User::where('id', '=', $course->user_id)->get()[0]->name

                ];
                $i++;
            }
        }
        //dd($data);
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
    public function add_course() {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $course_id = request()->course_id;
        //dd($course_id);
        DB::table('student_courses')->insert([
            array(
                'user_id' => $user_id,
                'course_id' => $course_id,
            )
        ]);
        $data = $user->student_courses;
        return redirect(route('home'));
    }

    public function course_info() {
        $course_id = request()->course_id;
        $course = Courses::where('id', '=', $course_id)->get();
        //dd($course);
        $data = [
            "course" => $course[0],
            "teacher" =>  User::where('id', '=', $course[0]->user_id)->get()[0]->name
        ];
        //dd($data);
        return view('student.course_info', compact('data'));

    }

}
