<?php

namespace App\Http\Middleware;

use App\Models\Content;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Courses;


class HasContent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $course_id = $request->course_id;
        $content_id = $request->content_id;
        $user = Auth::id();

        $content = Content::find($content_id);
        if($content && $content->course_id == $course_id) {
            $course = Courses::find($course_id);
            if($course && $course->user_id == $user) {
                return $next($request);
            }
        }
        return(redirect('home'));
    }
}
