<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstructorAuthRequest extends FormRequest
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
            'email' => ['required' ,'email', 'exists:instructors'],
            'password' => ['required', 'min:5'],
        ];
    }
    public function messages() : array
    {
        return [
            'email.required' => 'Please enter your email',
            'email.email' => 'Please enter a valid email',
            'email.exists' => 'The email is not found',
            'password.required' => 'Please enter your password',
            'password.min' => 'the password must be at least 5 characters',
        ];
    }

}

