<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseFileRequest;
use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseFileRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\V1\CourseResource;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return response()->json([
            'courses' =>  CourseResource::collection($courses)
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
    public function store(StoreCourseRequest $request,
    // StoreCourseFileRequest $fileRequest
    )
    {
        $validated = $request->all();
        if($request->file('image'))
        {
            $validated['image'] = handleFileUpload($request->file("image"), 'store', 'courseImg');
        }
        $course = Course::create([
            'type' => $validated['type'],
            'title' => $validated['title'],
            'course_start_time' => $validated['course_start_time'],
            'start_date' => $validated['start_date'],
            'expected_end_date' => $validated['expected_end_date'],
            'description' => $validated['description'],
            'duration' => $validated['duration'],
            'level' => $validated['level'],
            'image' => $validated['image']
        ]);

        if($request->course_student_id)
        {
            foreach($request->input('course_student_id') as $key => $val)
            {
                $course->students()->attach([$validated['course_student_id'][$key]]);
            }
        }

        if($request->course_instructor_id)
        {
            foreach($request->input('course_instructor_id') as $key => $val)
            {
                $course->instructors()->attach([$validated['course_instructor_id'][$key]]);
            }
        }

        if($request->lesson_id)
        {
            foreach($request->input('lesson_id') as $key => $val)
            {
                $course->lessons()->attach([$validated['lesson_id'][$key]]);
            }
        }

        // if($request->file_name && $request->file_path){
        //     $validation = $fileRequest->all();
        //     $course->courseFiles()->create([
        //         'course_id' => $course->id,
        //         'file_name' => $validation['file_name'],
        //         'file_path' => $validation['file_path'],
        //     ]);
        // }

        return response()->json([
            'course' => new CourseResource($course)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);
        if(!$course)
        {
            return response()->json([
                'message' => 'course is not found'
            ]);
        }
        return response()->json([
            'course' => new CourseResource($course)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, $id, UpdateCourseFileRequest $fileRequest)
    {
        $validated = $request->all();
        if($request->file('image'))
        {
            $validated['image'] = handleFileUpload($request->file("image"), 'update', 'courseImg');
        }
        $course = Course::findOrFail($id);
        $course->update([
            'type' => $validated['type'],
            'title' => $validated['title'],
            'course_start_time' => $validated['course_start_time'],
            'start_date' => $validated['start_date'],
            'expected_end_date' => $validated['expected_end_date'],
            'description' => $validated['description'],
            'duration' => $validated['duration'],
            'level' => $validated['level'],
            'image' => $validated['image']
        ]);

        $course->students()->sync($validated['course_student_id']);
        $course->instructors()->sync($validated['course_instructor_id']);
        $validatedFile = $fileRequest->all();

        if($request->file_name && $request->file_path){
            $course->courseFiles()->update([
                'course_id' => $course->id,
                'file_name' => $validatedFile['file_name'],
                'file_path' => $validatedFile['file_path'],
            ]);
        }

        return response()->json([
            'message' => 'course updated',
            'course' => new CourseResource($course),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        if(!$course)
        {
            return response()->json([
                'message' => 'course is not found'
            ]);
        }
        $course->delete();
        return response()->json([
            'message' => 'course deleted',
        ]);
    }

// Controller
public function syncStudents(Request $request, $id)
{
    $course = Course::findOrFail($id);
    $validated = $request->validate([
        'student_ids' => 'required|array',
        'student_ids.*' => 'exists:students,id',
    ]);
    $course->students()->sync($validated['student_ids']);
    return response()->json(['message' => 'Students updated successfully.']);
}

}
