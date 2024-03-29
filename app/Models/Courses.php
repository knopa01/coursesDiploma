<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    public function contents()
    {
        return $this->hasMany(Content::class, 'course_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function student_courses()
    {
        return $this->hasMany(StudentCourse::class, 'course_id', 'id');
    }
}
