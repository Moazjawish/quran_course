<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TahfeezCourse extends Model
{
    /** @use HasFactory<\Database\Factories\TahfeezCourseFactory> */
    use HasFactory;
    protected $guarded = [];
    public function instructors()
    {
        return $this->hasMany(Instructor::class);
    }

    public function students()
    {
        return $this->hasOne(Student::class);
    }
}
