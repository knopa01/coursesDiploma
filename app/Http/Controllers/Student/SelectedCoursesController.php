<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Courses;
use App\Models\StudentCourse;

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
                $student_course_id = $course->id;
                $teacher_id = $course_data->user_id;
                $teacher_name = User::where('id', '=', $teacher_id)->get()[0]->name;
                //echo($teacher_id);
                //echo($teacher_name."\n");
                $data[$i] = [
                    "student_course_id" =>$student_course_id,
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
        $message = null;
        return view('student.add_course', compact('message'));
    }
    public function find_course(Request $request)
    {
        $msg = request()->msg;
        $name = $request->name;
        $courses = Courses::where('course_name', 'LIKE', "%{$name}%")->get();

        if($name != "" && count($courses) == 0 ) {
            $msg = "По Вашему запросу ничего не найдено!";

        }
        $data = [];
        if (count($courses) != 0)
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
        } else {
            $courses = Courses::all();
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
        //dd($data);




        return view('student.find_course', compact('data', 'msg'));
    }
    public function add_course() {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $course_id = request()->course_id;
        $find_course = StudentCourse::where([
            ['user_id', '=', $user_id],
            ['course_id', '=', $course_id]
        ])->get();
        if($find_course->count() == 0) {
            $course = new StudentCourse();
            $course->user_id = $user_id;
            $course->course_id = $course_id;
            $course->save();
            $data = $user->student_courses;
            return redirect(route('home'));
        } else {
            $msg = "Вы уже изучаете данный курс!";
           // return view('student.add_course', compact('message'));
            return redirect(route('find_course', ['msg' => $msg]));
            //return redirect(route('search_course'));
        }
        //dd($find_course);
        //dd($course_id);

        /*
        DB::table('student_courses')->insert([
            array(
                'user_id' => $user_id,
                'course_id' => $course_id,
            )
        ]);
        */
    }

    public function course_info() {
        $course_id = request()->course_id;
        $course = Courses::where('id', '=', $course_id)->get();
        $data = [];
        //dd($course);
        if(count($course) != 0) {
            $data = [
                "course" => $course[0],
                "teacher" =>  User::where('id', '=', $course[0]->user_id)->get()[0]->name
            ];
        }

        //dd($data);
        return view('student.course_info', compact('data'));

    }
    public function delete_student_course() {
        $student_course_id = request()->student_course_id;
        //dd($course_id);
        $student_course_id = StudentCourse::find($student_course_id);
        //dd($student_course_id);
        $student_course_id->delete();
        $message = "Курс удален";
        $ctrl = "course";
        return view("teacher.courses.done", ['message'=>$message,'ctrl'=>$ctrl, 'course_id'=>null, 'content_id'=>null]);
    }

}
