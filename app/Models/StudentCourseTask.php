<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourseTask extends Model
{
    use HasFactory;
    public function student_course()
    {
        return $this->belongsTo(StudentCourse::class, 'student_course_id', 'id');
    }
    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }
}
