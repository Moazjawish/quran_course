<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = getStudentRelations($this->name);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'certificate' => $this->certificate,
            'student_img' => $this->student_img,
            'birth_date' => $this->birth_date,
            'quran_memorized_parts' => $this->quran_memorized_parts,
            'quran_passed_parts' => $this->quran_passed_parts,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'enroll_date' => $this->enroll_date,
            'role' => $this->role,
            'reset_password_token' => $this->reset_password_token,
            'attendances' =>$data->attendances,
            'related_courses' =>$data->courses,
            'related_exams' =>$data->studentExams,
        ];
    }
}
