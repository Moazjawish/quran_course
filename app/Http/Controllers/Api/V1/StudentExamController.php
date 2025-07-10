<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\StudentExam;
use App\Http\Requests\StoreStudentExamRequest;
use App\Http\Requests\UpdateStudentExamRequest;
use App\Http\Resources\V1\StudentExamResource;

class StudentExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentExams = StudentExam::all();
        return response()->json([
            'studentExams' => StudentExamResource::collection($studentExams),
        ]);
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
        $studentExam = StudentExam::create([
            'student_id' => $validated['student_id'],
            'exam_id' => $validated['exam_id'],
            'student_mark' => $validated['student_mark'],
        ]);
        return response()->json([
            'studentExam' => new  StudentExamResource($studentExam),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $studentExam = StudentExam::findOrFail($id);
        if(!$studentExam)
        {
            return response()->json([
                'message' => "exams is not found",
            ]);
        }
        return response()->json([
            'studentExam' => new  StudentExamResource($studentExam),
        ]);
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
    public function update(UpdateStudentExamRequest $request, $id)
    {
        $studentExam = StudentExam::findOrFail($id);
        $validated = $request->all();
        $studentExam->update([
            'student_id' => $validated['student_id'],
            'exam_id' => $validated['exam_id'],
            'student_mark' => $validated['student_mark'],
        ]);
        return response()->json([
            'studentExam' => new  StudentExamResource($studentExam),
            'message' => "exams is updated successfully",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $studentExam = StudentExam::findOrFail($id);
        if(!$studentExam)
        {
            return response()->json([
                'message' => "exams is not found",
            ]);
        }
        $studentExam->delete();
        return response()->json([
            'message' => "exams is deleted successfully",
        ]);
    }
}
