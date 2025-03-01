<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\StudentExam;
use App\Http\Requests\StoreStudentExamRequest;
use App\Http\Requests\UpdateStudentExamRequest;
use App\Http\Resources\V1\StudentExamCollection;
use App\Http\Resources\V1\StudentExamResource;

class StudentExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentExams = StudentExam::all();
        return new StudentExamCollection($studentExams);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentExamRequest $request)
    {
        $validated = $request->all();
        StudentExam::create([
            'student_id' => $validated['studentId'],
            'exam_id' => $validated['examId'],
            'student_mark' => $validated['studentMark'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentExam $studentExam)
    {
        return new StudentExamResource($studentExam);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentExam $studentExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentExamRequest $request, StudentExam $studentExam)
    {
        $validated = $request->all();
        $studentExam->update([
            'student_id' => $validated['studentId'],
            'exam_id' => $validated['examId'],
            'student_mark' => $validated['studentMark'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentExam $studentExam)
    {
        $studentExam->delete();
    }
}
