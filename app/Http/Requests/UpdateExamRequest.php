<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExamRequest extends FormRequest
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
            'course_id'=>['required'],
            'title' => ['required'],
            'exam_date'=>['required' ,'date' ,'date_format:Y-m-d',],
            'max_mark'=>['required'],
            'passing_mark'=>['required'],
        ];
    }
    public function messages()
    {
        return[''];
    }
}
