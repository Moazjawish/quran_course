<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Attendance;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AttendanceCollection;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendance = Attendance::all();
        return new AttendanceCollection($attendance);
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
    public function store(StoreAttendanceRequest $request)
    {
        $validated = $request->all();
        Attendance::create([
            'lesson_id' => $validated['lessonId'],
            'student_id' => $validated['studentId'],
            'student_attendance' => $validated['studentAttendance'],
            'student_attendance_time' => $validated['studentAttendanceTime'],
            'recitation_per_page' => $validated['recitationPerPage'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $validated = $request->all();
        $attendance->update([
            'lesson_id' => $validated['lessonId'],
            'student_id' => $validated['studentId'],
            'student_attendance' => $validated['studentAttendance'],
            'student_attendance_time' => $validated['studentAttendanceTime'],
            'recitation_per_page' => $validated['recitationPerPage'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
    }
}
