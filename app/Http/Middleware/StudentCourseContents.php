<?php

namespace App\Http\Middleware;

use App\Models\Content;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentCourse;
use App\Models\Courses;


class StudentCourseContents {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        /*
        $url = request()->headers->get('referer');
        $parts = parse_url( $url );
        $route = "";
        if($parts["path"] == "/study-results") {
            $route = 'study-results';
        } else {
            $route = "/home";
        }
        //dd($parts["path"]);
        */

        //dd($page);
        $course_id = $request->course_id;
        $course = Courses::find($course_id);
        $student_course_id = $request->student_course_id;
        $user = Auth::id();
        $student_course = StudentCourse::find($student_course_id);
        if($student_course && $course) {

            if($student_course->user_id == $user && $student_course->course_id == $course_id) {

                $page = $request->page;
                if($page != null) {
                    $course_count = Content::where('course_id', '=', $course_id)->count();
                    //dd($course_count);
                    if($page <= $course_count) {
                        return $next($request);
                    }
                } else{
                    return $next($request);
                }
            }
        }
        return(redirect('home'));
    }
}
