<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /*
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = getLessonRelations($this->id);
        return [
            'id' => $this->id,
            'related_Courses' => $data->courses,
            'related_instructors' => $data->instructors,
            // 'related_students' => $data->students,
            'lesson_title' => $this->lesson_title,
            'lesson_date' => $this->lesson_date,
            'attendance' => $data->attendances,
        ];
    }
}

/*

 */
