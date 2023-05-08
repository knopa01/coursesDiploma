<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Courses;


class HasCourses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $course_id = $request->course_id;
        $user = Auth::id();
        $course = Courses::find($course_id);
        if($course) {
            if($course->user_id == $user) {
                return $next($request);
            }
        }
        return(redirect('home'));
    }
}
