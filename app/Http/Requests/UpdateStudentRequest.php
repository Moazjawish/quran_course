<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
            'name' => ['required', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u','min:7',
            Rule::unique('students')->ignore($this->id)],
            'email' => ['required' , 'email', Rule::unique('students')->ignore($this->id)],
            'password' => ['required' , 'min:3','confirmed'],
            'certificate' => ['required' , 'min:3'],
            'student_img' => ['required'],
            'birth_date' => ['required'],
            'quran_memorized_parts' => ['required'  ],
            'quran_passed_parts' => ['required'  ],
            'phone_number' => ['required'  ],
            'address' => ['required' , 'min:3'],
            'enroll_date' => ['required'],
            'reset_password_token' => ['nullable' , 'min:3', 'nullable'],
        ];
    }
/*

*/

    public function messages()
    {
        return [

            'name.unique' => 'the username is exist',
            'name.regex' => 'invalid username ',
            'email.unique' => 'the email is exist',
            'password.min' => 'the password must be at least 5 characters',
            'password.confirmed' => 'the password dismatch',
            'phoneNumber.regex' => 'invalid phone number',

        ];
    }
}
