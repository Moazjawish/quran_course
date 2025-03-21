<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Instructor extends Model
{
    /** @use HasFactory<\Database\Factories\InstructorFactory> */
    use HasApiTokens, HasFactory;

    protected $guarded = [];
    public function tahfeezCourse()
    {
        return $this->belongsTo(TahfeezCourse::class);
    }

    public function lessons()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_instrcutor');
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
