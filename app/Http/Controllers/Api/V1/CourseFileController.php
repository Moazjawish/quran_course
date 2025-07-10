<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\CourseFile;
use App\Http\Requests\StoreCourseFileRequest;
use App\Http\Requests\UpdateCourseFileRequest;
use App\Http\Resources\V1\CourseFilesResource;

class CourseFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courseFiles = CourseFile::all();
        return response()->json([
            'coursesFiles' => CourseFilesResource::collection($courseFiles),
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
    public function store(StoreCourseFileRequest $request)
    {
        $data = $request->validated();
        if($request->file('file_path'))
        {
            $data['file_path'] = handleFileUpload($request->file('file_path'), 'store', 'courseFiles');
        }
        $data['course_id'] = $request->course_id;
        $courseFile = CourseFile::create($data);
        return response()->json([
            'courseFile' => $courseFile,
            'message' => 'file uploaded'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $courseFile = CourseFile::findOrFail($id);
        if(!$courseFile)
        {
            return response()->json([
                'message' => "File not found"
            ]);
        }
            return response()->json([
                'coursesFiles' =>new CourseFilesResource($courseFile),
            ]);
    }

    /*
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
        $data['file_name'] = $request->file_name;
        $courseFile->update($data);
        return response()->json([
            'courseFile' => $courseFile,
            'message' => 'file updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $courseFile = CourseFile::findOrFail($id);
        if(!$courseFile)
        {
            return response()->json([
                'message' => "File not found"
            ]);
        }
            $courseFile->delete();
            return response()->json([
                'message' => "file is deleted succssfully"
            ]);
    }
}
