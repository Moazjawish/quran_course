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
            'name' => ['required', Rule::unique('students'), 'regex:/(^([a-zA-Z]+)(\d+)?$)/u','min:7'],
            'email' => ['required' , 'email', Rule::unique('students'),],
            'password' => ['required' , 'min:3','confirmed'],
            'certificate' => ['required' , 'min:3'],
            'studentImg' => ['required', 'image'],
            'birthDate' => ['required'],
            'quranMemorizedParts' => ['required' , ],
            'quranPassedParts' => ['required' , ],
            'phoneNumber' => ['required' , ],
            'address' => ['required' , 'min:3'],
            'enrollDate' => ['required'],
            'resetPasswordToken' => ['required' , 'min:3', 'nullable'],
        ];
    }

    public function messages()
    {
        return [

            'name.unique' => 'the username is exist',
            'name.regex' => 'invalid username ',
            'email.unique' => 'the email is exist',
            'password.min' => 'the password must be at least 5 characters',
            'password.confirmed' => 'the password dismatch',
            'certificate' => '',
            'studentImg' => '',
            'phoneNumber.regex' => 'invalid phone number',
            'quranMemorizedParts' => '',
            'quranPassedParts' => '',
            'enrollDate' => '',
            'address' => '',
            'birthDate' => '',
        ];
    }

}
