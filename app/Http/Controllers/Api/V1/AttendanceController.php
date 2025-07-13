<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Attendance;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AttendanceResourse;
use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /*
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendance = Attendance::all();
        return response()->json([
            'attendance' =>  AttendanceResourse::collection($attendance)
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $lesson_id = $request->lesson_id;
            $lesson_courses = Lesson::find($lesson_id)->courses;
            foreach($lesson_courses as $course)
            {
                $course_students[] =  $course->students->toArray();
            }
            foreach($course_students as $course_student)
            {
                foreach($course_student as $course_std)
                {
                    $attendances[] = Attendance::create([
                        'lesson_id' => $lesson_id,
                        'student_id' => $course_std['id'],
                        'student_attendance' => 0,
                        'student_attendance_time' =>null,
                    ]);
                }
            }
        return response()->json([
            'attendance' =>  AttendanceResourse::collection($attendances)
        ], 200);
    }
    /*
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $validated = $request->all();
        $attendance->update([
            'lesson_id' => $validated['lesson_id'],
            // 'instructor_id' => $validated['instructor_id'],
            'student_id' => $validated['student_id'],
            'student_attendance' => $validated['student_attendance'],
            // 'instructor_attendance' => $validated['instructor_attendance'],
            'student_attendance_time' => $validated['student_attendance_time'],
            // 'instructor_attendance_time' => $validated['instructor_attendance_time'],
        ]);
        return response()->json([
            'attendance' => new AttendanceResourse($attendance)
        ], 200);
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
    }

    public function updateStudentAttendance($lesson_id, $student_id, Request $request)
    {
        $attendance = Attendance::all();
        $lesson_attendance = Attendance::where("lesson_id",$lesson_id)->where('student_id',$student_id)->first();
        $student_id = Student::findOrFail($student_id);
        $validated = $request->validate([
            'student_attendance' => 'required',
            'student_attendance_time' => 'required',
        ]);
        if($lesson_attendance)
        {
            $lesson_attendance->update([
                "student_attendance"=> $validated['student_attendance'],
                "student_attendance_time"=>$validated['student_attendance_time'],
            ]);
        }
        return response()->json([
            'attendance' =>  AttendanceResourse::collection($attendance)
        ]);
    }
}
