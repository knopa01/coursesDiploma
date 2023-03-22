<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    public function courses()
    {
        return $this->hasMany(Courses::class, 'language_id', 'id');
    }
}
