<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GetUserTypeController;
use App\Http\Controllers\Teacher\ManageCourseController;
use App\Http\Controllers\Teacher\CourseContentController;
use App\Http\Controllers\Student\SelectedCoursesController;
use App\Http\Controllers\Student\TrainingController;
use App\Http\Controllers\Teacher\StudyResultsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
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
    return view('start_page');
});

Auth::routes();
//register
Route::get('/register', [RegisterController::class, 'register_form'])->name('register_form');
Route::post('/register/submit', [RegisterController::class, 'register'])->name('myregister');


//settings
Route::get('/settings', [HomeController::class, 'settings_form'])->name('settings_form');
Route::post('/settings/save', [HomeController::class, 'save_settings'])->name('save_settings');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//admin
Route::get('/admin', [AdminController::class, 'index'])->middleware('auth')->name('admin');
Route::match(['get', 'post'],'/admin/groups', [AdminController::class, 'show_groups'])->middleware('auth')->name('admin_groups');
Route::match(['get', 'post'],'/admin/groups/edit', [AdminController::class, 'edit_form'])->middleware('auth')->name('edit_form');
Route::post('/admin/groups/update', [AdminController::class, 'edit_group'])->middleware('auth')->name('edit_group');
Route::get('/admin/groups/delete', [AdminController::class, 'delete_group'])->middleware(['auth'])->name('delete_group');
Route::get('/admin/groups/create', [AdminController::class, 'create_form'])->middleware(['auth'])->name('create_form');
Route::post('/admin/groups/save', [AdminController::class, 'create_group'])->middleware(['auth'])->name('create_group');

Route::get('/home', [GetUserTypeController::class, 'index'])->name('home');
//teacher


//course
Route::get('/home/create-course', [ManageCourseController::class, 'show_form'])->middleware(['auth'])->name('create_course');
Route::post('/home/create-course/submit', [ManageCourseController::class, 'create_course'])->middleware(['auth'])->name('created_course');
Route::get('/home/course', [CourseContentController::class, 'index'])->middleware(['auth', 'courses'])->name('manage_course');
Route::get('/home/delete-course', [ManageCourseController::class, 'delete_course'])->middleware(['auth', 'courses' ])->name('delete_course');
//course content
Route::get('/home/course/create-content', [CourseContentController::class, 'show_form'])->middleware(['auth', 'courses'])->name('create_content');
Route::get('/home/course/content', [CourseContentController::class, 'show_content'])->middleware(['auth', 'courses', 'contents'])->name('manage_content');
Route::post('/home/edit-content/submit', [CourseContentController::class, 'edit_content'])->middleware(['auth'])->name('edit_content');
Route::get('/home/delete-content', [CourseContentController::class, 'delete_content'])->middleware(['auth', 'contents'])->name('delete_content');
Route::post('/home/create-content/submit', [CourseContentController::class, 'create_content'])->middleware(['auth'])->name('created_content');
Route::post('/home/edit-course/submit', [CourseContentController::class, 'edit_course'])->middleware(['auth', 'courses'])->name('edit_course');
//tests
Route::get('/home/course/content/create-test', [CourseContentController::class, 'create_test_form'])->middleware(['auth', 'contents'])->name('create_test');
Route::post('/home/course/content/submit', [CourseContentController::class, 'create_test'])->middleware(['auth'])->name('created_test');
Route::get('/home/course/content/test', [CourseContentController::class, 'show_test'])->middleware(['auth', 'tests'])->name('manage_test');
Route::post('/home/edit-test/submit', [CourseContentController::class, 'edit_test'])->middleware(['auth'])->name('edit_test');
Route::get('/home/delete-test', [CourseContentController::class, 'delete_test'])->middleware(['auth', 'tests'])->name('delete_test');

//study results
Route::get('/study-results', [StudyResultsController::class, 'index'])->middleware(['auth'])->name('study_results');
Route::get('/study-results/show', [StudyResultsController::class, 'show_results'])->middleware(['auth'])->name('show_study_results');
Route::match(['get', 'post'],'/study-results/student', [StudyResultsController::class, 'find_student'])->middleware(['auth'])->name('find_student');
Route::match(['get', 'post'],'/study-results/search', [StudyResultsController::class, 'show_study_form'])->middleware(['auth', 'courses'])->name('show_study_form');
Route::match(['get', 'post'],'/study-results/group', [StudyResultsController::class, 'group_results'])->middleware(['auth'])->name('group_results');


//student
//Route::get('/home/search', [SelectedCoursesController::class, 'search_course'])->middleware(['auth'])->name('search_course');
Route::match(['get', 'post'],'/home/search-course', [SelectedCoursesController::class, 'find_course'])->middleware(['auth'])->name('find_course');
Route::get('/home/about', [SelectedCoursesController::class, 'course_info'])->middleware(['auth'])->name('course_info');
Route::post('/home/add-course', [SelectedCoursesController::class, 'add_course'])->middleware(['auth'])->name('add_course');
Route::get('/home/courses', [TrainingController::class, 'course_content'])->middleware(['auth', 'student_courses'])->name('course_content');
Route::post('/home/course/studying/test', [TrainingController::class, 'test_code'])->middleware(['auth'])->name('test_code');
Route::get('/home/course/studying', [TrainingController::class, 'show_content'])->middleware(['auth', 'student_course_content'])->name('show_content');
Route::get('/home/delete-student-course', [SelectedCoursesController::class, 'delete_student_course'])->middleware(['auth', 'student_courses'])->name('delete_student_course');



