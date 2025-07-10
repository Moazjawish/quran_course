<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
class StoreCourseRequest extends FormRequest
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
            'type' => ['required','regex:/^[a-zA-Z]+$/u'],
            'title' => ['required', 'regex:/^[a-zA-Z]+$/u'],
            'description' => ['required'],
            'duration' => ['required'],
            'level' => ['required'],
            'image' => ['required', 'image'],
            'course_start_time' => ['required'],
            'start_date' => ['required','date' ,'date_format:Y-m-d','after:'. Carbon::now()],
            'expected_end_date' => ['required','date','date_format:Y-m-d','after:start_date'],
            'course_student_id' => ['required','array'],
            'course_student_id.*' => ['exists:students,id'],
            'course_instructor_id' => ['required','array'],
            'course_instructor_id.*' => ['exists:instructors,id'],
        ];
    }

    public function messages()
    {
        return[
            'start_date' => "the course start date must be after  " . Carbon::now()->toDateString(),
            'title.regex' => "numbers or special character are not allowed",
            'type.regex' => "numbers or special character are not allowed",
        ];
    }
}
