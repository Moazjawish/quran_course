<?php

namespace App\Http\Resources\V1;

use App\Models\Exam;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentExamResource extends JsonResource
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
            'studentId' => Student::find($this->student_id),
            'examId' => Exam::find($this->exam_id),
            'studentMark' => $this->student_mark,
        ];
    }
}
