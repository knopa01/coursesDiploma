<?php

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
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
        array_push($student_courses_done,
            StudentCourse::where([
                ["course_id", "=",  $course_id],
                ["done_date", "<>", null]
            ])->get()[0]
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
        //current !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        $courses_in_progress = StudentCourse::where([
            ["course_id", "=",  $course_id],
            ["done_date", "=", null]
        ])->get();

        $tasks_in_progress = [];
        foreach ($courses_in_progress as $elem) {
                array_push(
                    $tasks_in_progress,
                    StudentCourseTask::where([
                        ["student_course_id", "=", $elem->id],
                        ["done_date", "<>", null]])->get()[0]);



            /*
            array_push($tasks_in_progress, StudentCourseTask::where([
                ["student_course_id", "=", $elem->id],
                ["done_date", "<>", null]
            ])->get()[0]);
            */
            //array_push($tasks_in_progress, $elem->user_id);
        }
        //dd($tasks_in_progress);


        //dd($tasks_in_progress);
        //dd($tasks_in_progress);
        //dd($student_courses_done, $student_courses_in_progress);
        return view("teacher.results.show_results", compact('tasks_in_progress','done', 'courses_in_progress'));
    }
}
