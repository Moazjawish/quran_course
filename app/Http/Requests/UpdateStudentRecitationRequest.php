<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRecitationRequest extends FormRequest
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
                    'lesson_id' => ['exists:lessons,id'],
                    'recitations' => ['array','required'],
                    // 'recitations.*.student_id' => ['exists:students,id', Rule::unique('student_recitation')],
                    'recitations.*.recitation_per_page' => ['required','numeric', 'min:0'],
                    'recitations.*.recitation_evaluation' => ['required','string'],
        ];
    }

    /**
     * Customize the error messages.
     */
    public function messages(): array
    {
        return [
            'lesson_id.required' => 'The Lesson ID is required.',
            'recitations.required' => 'You must provide recitation data.',
            // 'recitations.*.student_id.exists' => 'One of the students does not exist.',
            'recitations.*.recitation_per_page.required' => 'Recitation per page is required for each student.',
        ];
    }
}
