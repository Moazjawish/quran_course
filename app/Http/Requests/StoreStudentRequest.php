<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
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
            'name' => ['required' , 'min:3'],
            'email' => ['required' , 'email',Rule::unique('students')],
            'password' => ['required' , 'min:3'],
            'certificate' => ['required' , 'min:3'],
            'studentImg' => ['required' , 'min:3'],
            'birthDate' => ['required'],
            'quranMemorizedParts' => ['required' , ],
            'quranPassedParts' => ['required' , ],
            'phoneNumber' => ['required' , ],
            'address' => ['required' , 'min:3'],
            'enrollDate' => ['required'],
            'resetPasswordToken' => ['required' , 'min:3', 'nullable'],
        ];
    }
}
