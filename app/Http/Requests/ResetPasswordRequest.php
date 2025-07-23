<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'token' => ['required'],
            'password' => ['required', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'الرجاء إدخال الإيميل',
            'email.email' => ' الرجاء إدخال الإيميل بشكل صحيح',
            'password.required' => 'ادخل كلمة المرور',
            'password.confirmed' => 'ادخل تأكيد كلمة المرور',
        ];
    }
}
