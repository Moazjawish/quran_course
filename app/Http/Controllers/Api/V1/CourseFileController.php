<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\CourseFile;
use App\Http\Requests\StoreCourseFileRequest;
use App\Http\Requests\UpdateCourseFileRequest;
use App\Http\Resources\V1\CourseFilesCollection;
use App\Http\Resources\V1\CourseFilesResource;
use App\Models\Course;

class CourseFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courseFiles = CourseFile::all();
        $courseFileCollection = new  CourseFilesCollection($courseFiles);
        return  [
            'courseFile' => $courseFileCollection,
            'message' => 'All courses files '
        ];
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
        $data = $request->validated();
        if($request->file('file_path'))
        {
            $data['file_path'] = handleFileUpload($request->file('file_path'), 'store', 'courseFiles');
        }
        $data['course_id'] = $request->course_id;
        CourseFile::create($data);
        return [
            'file_path' => $data['file_path'],
            'message' => 'file uploaded'];
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
    public function update(UpdateCourseFileRequest $request, $id)
    {
        $data = $request->validated();
        $courseFile = CourseFile::findOrFail($id);
        if($request->file('file_path'))
        {
            $data['file_path'] = handleFileUpload($request->file('file_path'), 'update', 'courseFiles', $courseFile->file_path);
        }
        $data['course_id'] = $request->course_id;
        dd($data);
        $courseFile->update($data);
        return [
            'file_path' => $data['file_path'],
            'message' => 'file updated',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseFile $courseFile)
    {
        $courseFile->delete();
    }
}
