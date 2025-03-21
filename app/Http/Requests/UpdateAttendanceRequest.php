<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttendanceRequest extends FormRequest
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
            'lessonId' => ['required'],
            'studentId' => ['required'],
            'studentAttendance' => ['required'],
            'studentAttendanceTime' => ['required'],
            'recitationPerPage' => ['required'],
        ];
    }
    public function messages()
    {
        return[''];
    }
}
