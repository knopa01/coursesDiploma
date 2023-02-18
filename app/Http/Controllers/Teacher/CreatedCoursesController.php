<?php

namespace App\Http\Controllers\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CreatedCoursesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        return view("teacher.index");


    }
}
