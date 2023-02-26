<?php

namespace App\Http\Controllers\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\User;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Toast;
class CreatedCoursesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        $user = User::find(Auth::id());
        //$courses = Courses::where('user_id', $user);
        //$courses = Courses::all();
        //dd($user->courses);

        return view("teacher.courses.index", ['data' => $user->courses]);


    }
    public function create() {
        $input = Request::METHOD_GET;
        return $input;
    }

}
