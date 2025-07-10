<?php

namespace App\Models;
use App\Notifications\InstructorPasswordNotification;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Instructor extends Model implements CanResetPasswordContract
{
    use HasApiTokens, HasFactory, CanResetPasswordTrait, Notifiable;
    protected $guarded = [];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_instrcutor');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
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
        $this->notify(new InstructorPasswordNotification($token));
    }

}
