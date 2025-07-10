<?php

namespace App\Http\Resources\V1;
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
        $data = getAttendanceRelations($this->id);
        return [
            'id' => $this->id,
            'lesson_details' => $data->lessons,
            'student' =>   $data->students,
            'student_attendance' => $this->student_attendance,
            'student_attendance_time' => $this->student_attendance_time,
        ];
    }
}

