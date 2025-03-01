<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\CourseFile;
use App\Http\Requests\StoreCourseFileRequest;
use App\Http\Requests\UpdateCourseFileRequest;
use App\Http\Resources\V1\CourseFilesCollection;
use App\Http\Resources\V1\CourseFilesResource;

class CourseFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courseFiles = CourseFile::all();
        return new CourseFilesCollection($courseFiles);
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
    public function store(StoreCourseFileRequest $request)
    {
        $validated = $request->all();
        CourseFile::create([
            'courseId' => $validated['course_id'],
            'filePath' => $validated['file_path'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseFile $courseFile)
    {
        return new CourseFilesResource($courseFile);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseFile $courseFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseFileRequest $request, CourseFile $courseFile)
    {
        $validated = $request->all();
        $courseFile->update([
            'courseId' => $validated['course_id'],
            'filePath' => $validated['file_path'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseFile $courseFile)
    {
        $courseFile->delete();
    }
}
