<?php

namespace App\Http\Resources\V1;

use App\Models\Course;
use App\Models\Instructor;
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
        return [
            'id' => $this->id,
            // 'RelatedCourses' => Course::find($this->course_id),
            'RelatedCourses' => CourseResource::collection($this->whenLoaded('courses')),
            'RelatedInstructors' => Instructor::find($this->instructor_id),
            'lessonTitle' => $this->lesson_title,
            'lessonDate' => $this->lesson_date,
            'isTahfeezCourse' => $this->is_tahfeez_course,
        ];
    }
}

