<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = getCourseRelations($this->id);
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'course_start_time' => $this->course_start_time,
            'start_date' => $this->start_date,
            'expected_end_date' => $this->expected_end_date,
            "description"=> $this->description,
            "level"=>  $this->level,
            "image"=>  $this->image,
            'related_exams' => $data->exams,
            'course_files' => $data->courseFiles,
            'students' => $data->students,
            'instructor' => $data->instructors,
            'lessons' => $data->lessons,
        ];
    }
}
