<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    public function tahfeezCourse()
    {
        return $this->belongsTo(TahfeezCourse::class, 'student_id');
    }    

    public function attendances()
    {
        return $this->belongsTo(Attendance::class, 'student_id');
    }    
    public function courses()
    {
        return $this->belongsToMany(Course::class)->withTimestamps();
    }
    
    public function studentExams()
    {
        return $this->belongsTo(StudentExam::class, 'student_id');
    }   


}
