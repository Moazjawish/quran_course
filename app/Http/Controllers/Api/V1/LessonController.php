<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Lesson;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Http\Resources\V1\LessonCollection;
use App\Http\Resources\V1\LessonResource;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $lessons = Lesson::all();
        return new LessonCollection($lessons);
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
    public function store(StoreLessonRequest $request)
    {
        $validated = $request->all();
        Lesson::create([
            'course_id' => $validated['courseId'],
            'instructor_id' => $validated['instructorId'],
            'lesson_title' => $validated['lessonTitle'],
            'lesson_date' => $validated['lessonDate'],
            'is_tahfeez_course' => $validated['isTahfeezCourse'],
        ]);
    }
/*

instructorId
lessonTitle
lessonDate
isTahfeezCourse
*/
    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        return new LessonResource($lesson);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $validated = $request->all();
        $lesson->update([
            'course_id' => $validated['courseId'],
            'instructor_id' => $validated['instructorId'],
            'lesson_title' => $validated['lessonTitle'],
            'lesson_date' => $validated['lessonDate'],
            'is_tahfeez_course' => $validated['isTahfeezCourse'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
    }
}
