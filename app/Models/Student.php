<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model {
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasApiTokens, HasFactory;

    protected $guarded = [];

    public function tahfeezCourse()
    {
        return $this->belongsTo(TahfeezCourse::class);
    }

    public function attendances()
    {
        return $this->belongsTo(Attendance::class);
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student');
    }

    public function studentExams()
    {
        return $this->belongsTo(StudentExam::class);
    }


/**
 * Get the attributes that should be cast.
 *
 * @return array<string, string>
 */
protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

}
