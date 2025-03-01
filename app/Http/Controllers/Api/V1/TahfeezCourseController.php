<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\TahfeezCourse;
use App\Http\Requests\StoreTahfeezCourseRequest;
use App\Http\Requests\UpdateTahfeezCourseRequest;
use App\Http\Resources\V1\TahfeezCourseCollection;
use App\Http\Resources\V1\TahfeezCourseResource;

class TahfeezCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahfeezCourses = TahfeezCourse::all();
        return new TahfeezCourseCollection($tahfeezCourses);
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
    public function store(StoreTahfeezCourseRequest $request)
    {
        $validated = $request->all();
        TahfeezCourse::create([
            'student_id' => $validated['studentId'],
            'instructor_id' => $validated['instructorId'],
            'group_join_date' => $validated['groupJoinDate'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TahfeezCourse $tahfeezCourse)
    {
        return new TahfeezCourseResource($tahfeezCourse);
    }

    /*
     * Show the form for editing the specified resource.
     */
    public function edit(TahfeezCourse $tahfeezCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTahfeezCourseRequest $request, TahfeezCourse $tahfeezCourse)
    {
        $validated = $request->all();
        $tahfeezCourse->update([
            'student_id' => $validated['studentId'],
            'instructor_id' => $validated['instructorId'],
            'group_join_date' => $validated['groupJoinDate'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahfeezCourse $tahfeezCourse)
    {
        $tahfeezCourse->delete();
    }
}
