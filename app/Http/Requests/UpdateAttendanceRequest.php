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
            'lesson_id' => ['required','exists:lessons,id'],
            'student_id' => ['required','exists:students,id'],
            // 'instructor_id' => ['required','exists:instructors,id'],
            'student_attendance' => ['required'],
            // 'instructor_attendance' => ['required'],
            'student_attendance_time' => ['required'],
            // 'instructor_attendance_time' => ['required'],
        ];
    }
    public function messages()
    {
        return[''];
    }
}
