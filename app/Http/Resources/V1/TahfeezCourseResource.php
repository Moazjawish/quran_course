<?php

namespace App\Http\Resources\V1;

use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
 
class TahfeezCourseResource extends JsonResource
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
            'studentId'   => Student::find($this->student_id),
            'instructorId' => Instructor::find($this->instructor_id),
            'groupJoinDate' => $this->group_join_date,
        ];
    }
}
