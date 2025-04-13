<?php

namespace App\Models;

use App\Notifications\PasswordResetLinkNotificationation;
use Illuminate\Auth\Passwords\CanResetPassword as PasswordsCanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends  Authenticatable implements CanResetPassword {
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasApiTokens, HasFactory, Notifiable, PasswordsCanResetPassword;

    protected $fillable = ['name', 'password'];

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


public function sendPasswordResetNotification($token)
{
    $this->notify(new PasswordResetLinkNotificationation($token));
}
}
