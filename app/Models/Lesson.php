<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory;

    public function courses()
    {
        return $this->belongsTo(Course::class, 'lesson_id');
    }

    public function instructors()
    {
        return $this->hasMany(Instructor::class);
    }

    public function attendances()
    {
        return $this->belongsTo(Attendance::class, 'lesson_id');
    }
}
