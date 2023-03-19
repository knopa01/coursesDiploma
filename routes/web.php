<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\GetUserTypeController;
use App\Http\Controllers\Teacher\ManageCourseController;
use App\Http\Controllers\Teacher\CourseContentController;
use App\Http\Controllers\Student\SelectedCoursesController;
use App\Http\Controllers\Student\TrainingController;

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


Route::get('/home', [GetUserTypeController::class, 'index'])->name('home');
//teacher
//course
Route::get('/home/create-course', [ManageCourseController::class, 'show_form'])->middleware(['auth'])->name('create_course');
Route::post('/home/create-course/submit', [ManageCourseController::class, 'create_course'])->middleware(['auth'])->name('created_course');
Route::get('/home/course-{course_id}', [CourseContentController::class, 'index'])->middleware(['auth'])->name('manage_course');
Route::get('/home/delete-course', [ManageCourseController::class, 'delete_course'])->middleware(['auth'])->name('delete_course');
//course content
Route::get('/home/course-{course_id}/create-content', [CourseContentController::class, 'show_form'])->middleware(['auth'])->name('create_content');
Route::get('/home/course-{course_id}/{content_id}', [CourseContentController::class, 'show_content'])->middleware(['auth'])->name('manage_content');
Route::post('/home/edit-content/submit', [CourseContentController::class, 'edit_content'])->middleware(['auth'])->name('edit_content');
Route::get('/home/delete-content', [CourseContentController::class, 'delete_content'])->middleware(['auth'])->name('delete_content');
Route::post('/home/create-content/submit', [CourseContentController::class, 'create_content'])->middleware(['auth'])->name('created_content');
Route::post('/home/edit-course/submit', [CourseContentController::class, 'edit_course'])->middleware(['auth'])->name('edit_course');
//tests
Route::get('/home/course-{course_id}/content{content_id}/create-test', [CourseContentController::class, 'create_test_form'])->middleware(['auth'])->name('create_test');
Route::post('/home/course-{course_id}/content{content_id}/submit', [CourseContentController::class, 'create_test'])->middleware(['auth'])->name('created_test');
Route::get('/home/course{course_id}/content{content_id}/test{test_id}', [CourseContentController::class, 'show_test'])->middleware(['auth'])->name('manage_test');
Route::post('/home/edit-test/submit', [CourseContentController::class, 'edit_test'])->middleware(['auth'])->name('edit_test');
Route::get('/home/delete-test', [CourseContentController::class, 'delete_test'])->middleware(['auth'])->name('delete_test');
//student
Route::get('/home/search', [SelectedCoursesController::class, 'search_course'])->middleware(['auth'])->name('search_course');
Route::get('/home/searched', [SelectedCoursesController::class, 'find_course'])->middleware(['auth'])->name('find_course');
Route::get('/home/about', [SelectedCoursesController::class, 'course_info'])->middleware(['auth'])->name('course_info');
Route::post('/home/add-course', [SelectedCoursesController::class, 'add_course'])->middleware(['auth'])->name('add_course');
Route::get('/home/{course_id}', [TrainingController::class, 'course_content'])->middleware(['auth'])->name('course_content');
Route::get('/home/{course_id}/studying', [TrainingController::class, 'show_content'])->middleware(['auth'])->name('show_content');
//Route::get('/home/{course_id}/{content_id}', [TrainingController::class, 'next'])->middleware(['auth'])->name('next');
//Route::get('/home/{course_id}/{content_id}', [TrainingController::class, 'previous'])->middleware(['auth'])->name('previous');



