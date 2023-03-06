<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    public function course_plan()
    {
        return $this->hasOne(CoursePlan::class, 'course_id', 'id');
    }

}
