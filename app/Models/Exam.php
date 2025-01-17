<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    /** @use HasFactory<\Database\Factories\ExamFactory> */
    use HasFactory;
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function studentExams()
    {
        return $this->belongsTo(StudentExam::class, 'exam_id');
    } 
}
