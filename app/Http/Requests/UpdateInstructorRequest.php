<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInstructorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('instructors')],
            'email' => ['required', Rule::unique('instructors') ],
            'password' => ['required'],
            'certificate' => ['required'],
            'instructorImg' => ['required'],
            'phoneNumber' => ['required'],
            'quranMemorizedParts' => ['required'],
            'quranPassedParts' => ['required', 'nullable'],
            'religiousQualifications' => ['required', 'nullable'],
            'address' => ['required'],
            'birthDate' => ['required'],
            'isAdmin' => ['required'],
        ];
    }
}
