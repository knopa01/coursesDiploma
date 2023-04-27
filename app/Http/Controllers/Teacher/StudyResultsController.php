<?php

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Group;
use App\Models\User;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentCourse;
use App\Models\StudentCourseTask;
use Illuminate\Support\Facades\DB;

class StudyResultsController extends Controller
{
    public function index() {
        $user = User::find(Auth::id());
        //$data = $user->courses;
        $data = Courses::where("user_id", "=", $user->id)->orderBy("course_name")->get();
        return view("teacher.results.index", ['data' => $data]);
    }
    public function show_study_form() {
        $groups = Group::all();
        $course_id = request()->course_id;
        return view("teacher.results.results_form", compact('groups', 'course_id'));

    }
    public function group_results() {
        //dd(request()->group_id);
        $validator = request()->validate([

            'group_id' => function($attribute, $value, $fail) {
                if (request()->group_id == "Выберите значение") {
                    //dd("kekv");
                    $fail('Выберете группу!');
                }
            },'course_id' =>'required'


        ],[
            'group_id' => "Выберите значение!"

        ]);
        $msg = "";
        $group_id = request()->group_id;
        $course_id = request()->course_id;
        $main_info = [
            "group" => DB::table('groups')
                ->select('id', 'group_name')
                ->where("id", '=', $group_id)
                ->get()[0],
            "course" => DB::table('courses')
                ->select('id', 'course_name')
                ->where("id", '=', $course_id)
                ->get()[0],
            "students_count" => DB::table('student_courses')
                ->where("course_id", '=', $course_id)
                ->get()
                ->count()

        ];
        $groups = Group::all();
        //dd($main_info);
        $data = [

        ];

        //$students = User::where("user_group_id", '=', $group_id)->id->get();
        $students = DB::table('users')
            ->select('id', 'name', 'user_group_id')
            ->where("user_group_id", '=', $group_id)
            ->get();
        //dd($students);
        //$student_courses = [];
        if(count($students) != 0) {

           // $data = $data[0];
            //dd($data);
            foreach($students as $student) {
                $student_info = [
                    "student" => [],
                    "course" =>[]
                ];

                $student_info["student"] = $student;
                //dd($data);
                //array_push($data, $students);
                //dd($student->id);

                $student_course = DB::table('student_courses')
                    ->select('id', 'done_date', 'user_id', 'course_id')
                    ->where([
                        ["course_id", "=",  $course_id],
                        ["user_id", "=", $student->id]
                    ])
                    ->get();

                //dd($student_course);
                //$student_course = array($student_course);
                //dd($student_course[0]);
                //dd(count($student_course));
                if(count($student_course) != 0) {
                    $student_info["course"] = $student_course[0];
                    /*
                    $student_tasks = DB::table('student_course_tasks')
                        ->select('id', 'done_date', 'student_course_id', 'course_id')
                        ->where([
                            ["course_id", "=",  $course_id],
                            ["user_id", "=", $student->id]
                        ])
                        ->get();
                    */
                    //dd($student);
                    //array_push($data["student"]["course"], $student_course[0]);
                }
                //dd($student_info);


                array_push($data, $student_info);

            }
            //dd($data);


        } else {
            $msg = "Группа пуста.";
        }
        return(view("teacher.results.group_results", compact('msg', 'main_info', 'data', 'groups')));






    }
    //это не надо
    public function show_results() {
        $course_id = request()->course_id;
        //done
        $done = [];
        $student_courses_done = [];
        $students_done = [];
        $courses_done = StudentCourse::where([
            ["course_id", "=",  $course_id],
            ["done_date", "<>", null]
        ])->get();
        if (count($courses_done) != 0) {
            array_push($student_courses_done,
                $courses_done[0]
            );
            foreach($student_courses_done as $elem){
                array_push($students_done, User::where("id", "=", $elem->user_id)->get()[0]);
            }
            foreach($students_done as $student) {
                foreach($student_courses_done as $course) {
                    if($course->user_id == $student->id) {
                        array_push($done,["course"=>$course, "student"=>$student]);
                    }
                }
            }
        }

        //current

        $courses_in_progress = StudentCourse::where([
            ["course_id", "=",  $course_id],
            ["done_date", "=", null]
        ])->get();
        $in_progress = [];

        $users_in_progress = [];
        $tasks_in_progress = [];
        $tasks = [];
        foreach ($courses_in_progress as $elem) {
                $tasks = StudentCourseTask::where([
                    ["student_course_id", "=", $elem->id],
                    ["done_date", "<>", null]])->get();

                array_push(
                    $tasks_in_progress,
                    StudentCourseTask::where([
                        ["student_course_id", "=", $elem->id],
                        ["done_date", "<>", null]])->get());
                array_push(
                    $users_in_progress,
                    User::where([
                        ["id", "=", $elem->user_id]
                    ])->get()[0]

                );
        }
        //dd($tasks_in_progress);
        $task_arr = [];
        foreach($tasks_in_progress as $tasks) {
            foreach($tasks as $task) {
                $name = Content::where("id", "=", $task->content_id)->get()[0]->content_name;
                array_push($task_arr, ["task_info"=>$task, "task_name"=>$name]);
            }
        }
        //dd($task_arr);
        foreach($users_in_progress as $student) {
            foreach($courses_in_progress as $course) {
                if($course->user_id == $student->id) {
                    $lol = [];
                    foreach($task_arr as $task) {
                        if($task["task_info"]->student_course_id == $course->id) {
                            array_push($lol, $task);
                        }
                    }
                    array_push($in_progress,["student"=>$student, "course"=>$course, "tasks"=>$lol]);

                }
            }
        }
        $groups = Group::all();
        //dd($groups);
        //dd($in_progress);
        //dd($in_progress[0]["tasks"][0]["task_info"]->done_date);
        //dd($student_courses_done, $student_courses_in_progress);
        return view("teacher.results.show_results", compact('done','in_progress', 'course_id','groups'));
    }
     //это переписать
    public function find_student(Request $request)
    {
        $name = $request->name;

        $user_name = "";
        $course_id = $request->course_id;
        $user = [];
        $in_progress = [];
        $msg = null;
        $group_name = "";
        $group_id = null;
        if($name != null) {
            $user = User::where('name', 'LIKE', "%{$name}%")->get();

            //сделать для многих студентов
            if(count($user) != 0) {
                $user = $user[0];
                //dd($user);
                $user_name = $user->name;
                //$group = Group::where('id', '=', $user->user_group_id)->get()[0];
                $group = Group::where('id', '=', $user->user_group_id)->get()[0];
                //dd($group);
                $group_name = $group->group_name;
                $group_id = $group->id;
                //dd($group_name);
                $student_course = StudentCourse::where([
                    ["course_id", "=", $course_id],
                    ["user_id", "=", $user->id]
                ])->get();
                if (count($student_course) == 0) {
                    $msg = "Данный пользователь не изучает курс";
                } else {
                    $student_course = $student_course[0];
                    $task_arr = [];
                    $tasks_in_progress = [];
                    array_push(
                        $tasks_in_progress,
                        StudentCourseTask::where([
                            ["student_course_id", "=", $student_course->id],
                            ["done_date", "<>", null],
                            ])->get());
                    foreach($tasks_in_progress as $tasks) {
                        foreach($tasks as $task) {
                            $task_name = Content::where("id", "=", $task->content_id)->get()[0]->content_name;
                            array_push($task_arr, ["task_info"=>$task, "task_name"=>$task_name]);
                        }
                    }

                    array_push($in_progress,["student"=>$user, "course"=>$student_course, "tasks"=>$task_arr]);
                }

            } else {
                $msg = "Пользователь не найден!";

            }
        } else {
            $msg = "Введите имя студенета!";
        }

        //return redirect()->back()->with('msg', 'Задание выполнено верно!')->withInput();
        return view("teacher.results.show_student", ['in_progress' => $in_progress, 'course_id' => $course_id, 'msg' => $msg, 'name' =>$user_name, 'group_name' => $group_name, 'group_id' => $group_id]);

    }
    // удалить
    public function show_student($done, $in_progress, $course_id, $msg, $name) {

        //$done, $in_progress, $course_id, $msg, $name
        return view("teacher.results.show_student", ['done' => $done, 'in_progress' => $in_progress, 'course_id' => $course_id, 'msg' => $msg, 'name' =>$name]);
    }
}
