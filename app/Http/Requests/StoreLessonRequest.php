<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLessonRequest extends FormRequest
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
            'course_id' => ['required','exists:courses,id'],
            'instructor_id' => ['required','exists:instructors,id'],
            'lesson_title' => ['required', 'min:3', Rule::unique('lessons')],
        ];
    }

    public function messages()
    {
        return[''];
    }
}
