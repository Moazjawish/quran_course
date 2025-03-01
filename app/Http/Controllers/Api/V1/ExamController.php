<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Exam;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Http\Resources\V1\ExamCollection;
use App\Http\Resources\V1\ExamResource;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::all();
        return new ExamCollection($exams);
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
        Exam::create([
            'course_id'=> $validated['courseId'],
            'exam_date'=> $validated['examDate'],
            'max_mark'=> $validated['maxMark'],
            'passing_mark'=> $validated['passingMark'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        return new ExamResource($exam);
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
    public function update(UpdateExamRequest $request, Exam $exam)
    {
        $validated = $request->all();
        $exam->update([
            'course_id'=> $validated['courseId'],
            'exam_date'=> $validated['examDate'],
            'max_mark'=> $validated['maxMark'],
            'passing_mark'=> $validated['passingMark'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
    }
}
