<?php

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentCourse;
use App\Models\StudentCourseTask;
class StudyResultsController extends Controller
{
    public function index() {
        $user = User::find(Auth::id());
        $data = $user->courses;
        return view("teacher.results.index", ['data' => $data]);
    }
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

        //dd($in_progress);
        //dd($in_progress[0]["tasks"][0]["task_info"]->done_date);
        //dd($student_courses_done, $student_courses_in_progress);
        return view("teacher.results.show_results", compact('done','in_progress', 'course_id'));
    }
    public function find_student(Request $request)
    {
        $name = $request->name;
        $user_name = "";
        $course_id = $request->course_id;
        $user = [];
        $in_progress = [];
        $msg = null;
        if($name != null) {
            $user = User::where('name', 'LIKE', "%{$name}%")->get();
            if(count($user) != 0) {
                $user = $user[0];
                $user_name = $user->name;
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
        return view("teacher.results.show_student", ['in_progress' => $in_progress, 'course_id' => $course_id, 'msg' => $msg, 'name' =>$user_name]);

    }
    public function show_student($done, $in_progress, $course_id, $msg, $name) {

        //$done, $in_progress, $course_id, $msg, $name
        return view("teacher.results.show_student", ['done' => $done, 'in_progress' => $in_progress, 'course_id' => $course_id, 'msg' => $msg, 'name' =>$name]);
    }
}
