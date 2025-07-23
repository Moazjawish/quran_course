<?php

namespace App\Http\Resources\V1;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseFilesResource extends JsonResource
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
            'file_name' => $this->file_name,
            'file_path' => $this->file_path,
        ];
    }
}
