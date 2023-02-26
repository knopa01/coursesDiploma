<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\GetUserTypeController;
use App\Http\Controllers\Teacher\ManageCourseController;
use App\Http\Controllers\Teacher\CreatedCoursesController;
use App\Http\Controllers\Teacher\ReadyCourseController;
use App\Http\Controllers\Teacher\CourseContentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//teacher
Route::get('/home', [GetUserTypeController::class, 'index']);
//Route::post('/home', [CreatedCoursesController::class, 'create'])->name('created_course');;
Route::get('/home/create-course', [ManageCourseController::class, 'show_form'])->middleware(['auth']);
//Route::post('/home/create-course/submit', [CreateCourseController::class, 'create'])->middleware(['auth'])->name('created_course');
Route::post('/home/create-course/submit', [ManageCourseController::class, 'create_course'])->middleware(['auth'])->name('created_course');
Route::get('/home/{course_id}', [CourseContentController::class, 'index'])->middleware(['auth'])->name('manage_course');

