<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }
    public function student_course_tasks()
    {
        return $this->hasMany(StudentCourseTask::class, 'student_course_id', 'id');
        //return $this->hasMany(StudentCourseTask::class);
    }
}
