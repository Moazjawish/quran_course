<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstructorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = getInstructorRelations($this->email);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'certificate' => $this->certificate,
            'instructor_img' => $this->instructor_img,
            'phone_number' => $this->phone_number,
            'quran_memorized_parts' => $this->quran_memorized_parts,
            'quran_passed_parts' => $this->quran_passed_parts,
            'religious_qualifications' => $this->religious_qualifications,
            'address' => $this->address,
            'birth_date' => $this->birth_date,
            'role' => $this->role,
            'relatedCourses' => $data->courses,
            'relatedLessons' => $data->lessons,
        ];
    }
}

