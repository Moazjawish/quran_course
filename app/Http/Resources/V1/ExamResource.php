<?php

namespace App\Http\Resources\V1;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
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
            'course' => Course::find($this->course_id),
            "title" => $this->title,
            'exam_date' => $this->exam_date,
            'max_mark' => $this->max_mark,
            'passing_mark' => $this->passing_mark,
        ];
    }
}
