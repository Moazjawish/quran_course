<?php

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

if(!function_exists('handleFileUpload'))
{
    function handleFileUpload($file, $type, $directory, $old_path = null)
    {
        if ($type === 'update' && $old_path) {
            if (Storage::disk('public')->exists($old_path)) {
                Storage::disk('public')->delete($old_path);
            }
        }
        $file_name = time() . '_' . $file->hashName();
        $new_path = $file->storeAs($directory, $file_name, 'public');
        return env('APP_URL') . '/storage/' . $new_path;
    }
}

if(!function_exists('getCourseRelations'))
{
    function getCourseRelations($id)
    {
        return Course::where('id', $id)->with([
            'exams',
            'courseFiles',
            'students',
            'instructors',
            'lessons',
        ])->first();
    }
}

if(!function_exists('getStudentRelations'))
{
    function getStudentRelations($name)
    {
        return Student::where('name', $name)->with([
            'attendances',
            'courses',
            'studentExams',
        ])->first();
    }
}

if(!function_exists('getInstructorRelations'))
{
    function getInstructorRelations($email)
    {
        return Instructor::where('email', $email)->with([
            'lessons',
            'courses'
        ])->first();
    }
}

if(!function_exists('getLessonRelations'))
{
    function getLessonRelations($id)
    {
        return Lesson::where('id', $id)->with([
            'instructors',
            'courses',
            'attendances',
        ])->first();
    }
}

if(!function_exists('getAttendanceRelations'))
{
    function getAttendanceRelations($id)
    {
        return Attendance::where('id', $id)->with([
            'lessons',
            'students',
        ])->first();
    }
}


/*


*/
