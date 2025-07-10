<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseFile extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFileFactory> */
    use HasFactory;
    protected $guarded = [];
    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}

