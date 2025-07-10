<?php

namespace App\Models;

use App\Notifications\StudentResetPasswordNotification;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends  Authenticatable implements CanResetPassword {
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasApiTokens, HasFactory, Notifiable, CanResetPasswordTrait;

    protected $guarded = [];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student','student_id','course_id');
    }

    public function studentExams()
    {
        return $this->belongsTo(StudentExam::class);
    }

    public function studentRecitation()
    {
        return $this->belongsTo(StudentRecitation::class, 'student_id');
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


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new StudentResetPasswordNotification($token));
    }
}
