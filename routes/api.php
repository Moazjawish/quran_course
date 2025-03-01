<?php
use App\Http\Controllers\Api\V1\AttendanceController;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\CourseFileController;
use App\Http\Controllers\Api\V1\ExamController;
use App\Http\Controllers\Api\V1\InstructorController;
use App\Http\Controllers\Api\V1\LessonController;
use App\Http\Controllers\Api\V1\StudentController;
use App\Http\Controllers\Api\V1\StudentExamController;
use App\Http\Controllers\Api\V1\TahfeezCourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix'=>'v1'], function(){
    // students
    Route::apiResource('students', StudentController::class);
    Route::apiResource('students', StudentController::class)->only(['store']);
    Route::apiResource('students', StudentController::class)->only(['destroy']);
    Route::apiResource('students', StudentController::class)->only(['update']);
    //instructors
    Route::apiResource('instructors', InstructorController::class);
    Route::apiResource('instructors', InstructorController::class)->only(['store']);
    Route::apiResource('instructors', InstructorController::class)->only(['update']);
    Route::apiResource('instructors', InstructorController::class)->only(['destroy']);
    //lessons
    Route::apiResource('lessons', LessonController::class);
    Route::apiResource('lessons', LessonController::class)->only(['store']);
    Route::apiResource('lessons', LessonController::class)->only(['destroy']);
    Route::apiResource('lessons', LessonController::class)->only(['update']);
    //exams
    Route::apiResource('exams', ExamController::class);
    Route::apiResource('exams', ExamController::class)->only(['store']);
    Route::apiResource('exams', ExamController::class)->only(['destroy']);
    Route::apiResource('exams', ExamController::class)->only(['update']);
    //courses
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('courses', CourseController::class)->only(['store']);
    Route::apiResource('courses', CourseController::class)->only(['destroy']);
    Route::apiResource('courses', CourseController::class)->only(['update']);
    //atten
    Route::apiResource('atten', AttendanceController::class);
    Route::apiResource('atten', AttendanceController::class)->only(['store']);
    Route::apiResource('atten', AttendanceController::class)->only(['destroy']);
    Route::apiResource('atten', AttendanceController::class)->only(['update']);
    //tahfeez
    Route::apiResource('tahfeez', TahfeezCourseController::class);
    Route::apiResource('tahfeez', TahfeezCourseController::class)->only(['store']);
    Route::apiResource('tahfeez', TahfeezCourseController::class)->only(['destroy']);
    Route::apiResource('tahfeez', TahfeezCourseController::class)->only(['update']);
    //student_exam
    Route::apiResource('stdExam', StudentExamController::class);
    Route::apiResource('stdExam', StudentExamController::class)->only(['store']);
    Route::apiResource('stdExam', StudentExamController::class)->only(['destroy']);
    Route::apiResource('stdExam', StudentExamController::class)->only(['update']);
    //course_file
    Route::apiResource('courseFile', CourseFileController::class);
    Route::apiResource('courseFile', CourseFileController::class)->only(['store']);
    Route::apiResource('courseFile', CourseFileController::class)->only(['destroy']);
    Route::apiResource('courseFile', CourseFileController::class)->only(['update']);

});
