<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Http\Resources\V1\LessonResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = Lesson::all();
        return response()->json([
            'lessons' =>  LessonResource::collection($lessons)
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
    public function store(StoreLessonRequest $request)
    {
        $validated = $request->all();
        $lesson= Lesson::create([
            'lesson_title' => $validated['lesson_title'],
            'lesson_date' => Carbon::now(),
            'instructor_id' =>$validated['instructor_id'],
        ]);
//
        // if($request->course_id)
        // {
        //     $lesson->courses()->attach([$validated['course_id']]);
        // }
//

        if($request->course_id)
        {
            foreach($request->input('course_id') as $key => $val)
            {
                $lesson->courses()->attach([$validated['course_id'][$key]]);
            }
        }

//
        return response()->json([
            'lesson' =>  new LessonResource($lesson)
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);
        if(!$lesson)
        {
            return response()->json([
                'message' => 'lesson is not found'
            ]);
        }
        return response()->json([
            'lesson' =>  new LessonResource($lesson),
        ]);
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
    public function update(UpdateLessonRequest $request, $id)
    {
        $validated = $request->all();
        $lesson = Lesson::findOrFail($id);
        $lesson->update([
            'lesson_title' => $validated['lesson_title'],
            'lesson_date' => $validated['lesson_date'],
            'instructor_id' => $validated['instructor_id'],
        ]);

        if($request->course_id)
        {
            $lesson->courses()->sync([$validated['course_id']]);
        }

        return response()->json([
            'lesson' => new LessonResource($lesson),
            'message' => 'lesson updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        if(!$lesson)
        {
            return response()->json([
                'message' => 'lesson is not found'
            ]);
        }
        $lesson->delete();
        return response()->json([
            'message' => 'lesson deleted successfully'
        ]);
    }

public function LessonStudents($id)
{
    $lesson_courses = Lesson::find($id)->courses;
    foreach($lesson_courses as $course)
    {
        $course_students[] =  $course->students;
    }
    return response()->json([
        'students' => $course_students
    ]);
}

}
