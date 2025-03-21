<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInstructorRequest extends FormRequest
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
            'name' => ['required', Rule::unique('instructors'), 'regex:/(^([a-zA-Z]+)(\d+)?$)/u','min:7'],
            'email' => ['required', Rule::unique('instructors') ],
            'password' => ['required', 'min:5', 'confirmed'],
            'certificate' => ['required'],
            'instructorImg' => ['required'],
            'phoneNumber' => ['required','regex:/(0)[0-9]{9}/'],
            'quranMemorizedParts' => [''],
            'quranPassedParts' => [''],
            'religiousQualifications' => [''],
            'address' => ['required'],
            'birthDate' => ['required'],
            'isAdmin' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'the username is exist',
            'name.regex' => 'invalide username ',
            'email.unique' => 'the email is exist',
            'password.min' => 'the password must be at least 5 characters',
            'password.confirmed' => 'the password dismatch',
            'certificate' => '',
            'instructorImg' => '',
            'phoneNumber.regex' => 'invalid phone number',
            'quranMemorizedParts' => '',
            'quranPassedParts' => '',
            'religiousQualifications' => '',
            'address' => '',
            'birthDate' => '',
            'isAdmin' => ''
        ];
    }
}

