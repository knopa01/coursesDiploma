<?php

namespace App\Http\Controllers\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\User;
class ReadyCourseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function create()
    {
        //$user = User::find(Auth::id());
        //$courses = Courses::where('user_id', $user);
        //$courses = Courses::all();
        //dd($user->courses);
        //$course_name =
        $course = new Courses();

        return view("teacher.courses.done");


    }
}

