<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Exam;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Http\Resources\V1\ExamResource;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::all();
        return response()->json([
            'exams' => ExamResource::collection($exams),
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
    public function store(StoreExamRequest $request)
    {
        $validated = $request->all();
        $exam = Exam::create([
            'course_id'=> $validated['course_id'],
            'title'=> $validated['title'],
            'exam_date'=> $validated['exam_date'],
            'max_mark'=> $validated['max_mark'],
            'passing_mark'=> $validated['passing_mark'],
        ]);
        return response()->json([
            'exam' => new ExamResource($exam),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $exam = Exam::findOrFail($id);
        if(!$exam)
        {
            return response()->json([
                'message' => "exam is not found"
            ]);
        }
        return response()->json([
            'exam' => new ExamResource($exam),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExamRequest $request, $id)
    {
        $exam = Exam::findOrFail($id);
        $validated = $request->all();
        $exam->update([
            'course_id'=> $validated['course_id'],
            'title'=> $validated['title'],
            'exam_date'=> $validated['exam_date'],
            'max_mark'=> $validated['max_mark'],
            'passing_mark'=> $validated['passing_mark'],
        ]);
        return response()->json([
            'exam' => new ExamResource($exam),
            'message' => 'exam is updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        if(!$exam)
        {
            return response()->json([
                'message' => "exam is not found"
            ]);
        }
        $exam->delete();
        return response()->json([
            'message' => "exam is deleted succssfully"
        ]);

    }
}
