<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    public function tests()
    {
        return $this->hasMany(Test::class, 'content_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }
}
