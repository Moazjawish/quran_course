<?php

namespace App\Http\Resources\V1;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lessonDetails' =>   '',
            'student' =>   '',
            'student_attendance_time' => $this->student_attendance_time,
            'student_attendance' => $this->student_attendance,
            'recitation_per_page' => $this->recitation_per_page,
        ];
    }
}

