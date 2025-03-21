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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'certificate' => $this->certificate,
            'studentImg' => $this->student_img,
            'birthDate' => $this->birth_date,
            'quranMemorizedParts' => $this->quran_memorized_parts,
            'quranPassedParts' => $this->quran_passed_parts,
            'phoneNumber' => $this->phone_number,
            'address' => $this->address,
            'enrollDate' => $this->enroll_date,
            'role' => $this->role,
            'resetPasswordToken' => $this->reset_password_token,
        ];
    }
}
