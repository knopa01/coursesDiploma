<?php

namespace App\Http\Controllers\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Content;
use App\Models\User;
class TrainingController extends Controller
{
    public function course_content() {
        $course_id = request()->course_id;

        $course_data = Courses::find($course_id);
        //dd($course_data);
        $course_content = null;
        $teacher = null;
        $teacher = $course_data->user_id;
        $teacher = User::find($teacher)->name;
        $course_content = $course_data->contents->sortBy('sort');
        //dd($teacher, $course_content, $course_data);
        return view('student.course_content', compact('course_data', 'teacher', 'course_content'));

    }
    public function show_content() {
        $course_id = request()->course_id;
        $course_name = request()->course_name;
        $content_id = request()->content_id;
        $content = Content::find($content_id);
        if ($content->type_of_content == "task") {
            return view('student.show_task', compact('course_name', 'content'));
        } else {
            return view('student.show_lecture', compact('course_name', 'content'));
        }
    }
    public function next() {
        $content_id = request()->content_id;
        $current_content_sort = Content::find($content_id)->sort;
        dd($current_content_sort);

    }
    public function previous() {

    }

}

