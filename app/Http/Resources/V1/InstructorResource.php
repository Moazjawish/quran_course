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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'certificate' => $this->certificate,
            'instructorImg' => $this->instructor_img,
            'phoneNumber' => $this->phone_number,
            'quranMemorizedParts' => $this->quran_memorized_parts,
            'quranPassedParts' => $this->quran_passed_parts,
            'religiousQualifications' => $this->religious_qualifications,
            'address' => $this->address,
            'birthDate' => $this->birth_date,
            // 'isAdmin' => $this->is_admin,
            'role' => $this->role,
        ];
    }
}

