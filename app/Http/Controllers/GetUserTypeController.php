<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Teacher\ManageCourseController;
use App\Http\Controllers\Student\SelectedCoursesController;
use App\Http\Controllers\Admin\AdminController;
class GetUserTypeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        $id = Auth::id();
        $user = DB::table('users')->select('usertype')->where('id', '=', $id)->value('usertype');
        if ($user == 'teacher') {
            $result = (new ManageCourseController)->index();
            return $result;
        }

        else if ($user == 'student') {
            $result = (new SelectedCoursesController)->index();
            return $result;
        }
        else if($user == 'admin') {
            return redirect()->route('admin');
            //$result = (new AdminController)->index();
            //return $result;
        }
        //$usertype = $user['usertype'];
    }
}
