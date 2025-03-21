<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\{
    AttendanceController,
    CourseController,
    CourseFileController,
    ExamController,
    InstructorAuthController,
    InstructorController,
    LessonController,
    StudentAuthController,
    StudentController,
    StudentExamController,
    TahfeezCourseController
};
use App\Http\Middleware\RoleMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix'=>'v1'], function(){
    // students
    Route::group(['prefix' => 'students'] ,function(){
        Route::get('', [StudentController::class, 'index']);
        Route::get('/{id}', [StudentController::class, 'show']);
        Route::post('store', [StudentController::class, 'store']);
        Route::delete('delete', [StudentController::class, 'destroy']);
        Route::post('update/{id}', [StudentController::class, 'update']);
    });

    //instructors
    Route::middleware(['auth:sanctum','role:instructor,admin'])->prefix('instructors')->group(function(){
        Route::get('', [InstructorController::class, 'index']);
        Route::get('/{id}', [InstructorController::class, 'show']);
        Route::post('store', [InstructorController::class, 'store']);
        Route::delete('delete', [InstructorController::class,'destroy']);
        Route::post('update/{id}',[ InstructorController::class, 'update']);
    });

    //lessons
    Route::group(['prefix' => 'lessons'] ,function(){
        Route::get('/',[ LessonController::class, 'index']);
        Route::get('/{id}',[ LessonController::class, 'show']);
        Route::post('store', [LessonController::class, 'store']);
        Route::delete('delete', [LessonController::class ,'destroy']);
        Route::post('update/{id}', [LessonController::class, 'update']);
    });
    //exams
    Route::group(['prefix' => 'exams'], function(){
        Route::get('', [ExamController::class, 'index']);
        Route::get('/{id}', [ExamController::class, 'show']);
        Route::post('store', [ExamController::class, 'store']);
        Route::post('update/{id}',[ExamController::class,'update']);
        Route::delete('destroy', [ExamController::class, 'destroy']);
    });
    //courses
    Route::group(['prefix' => 'courses'], function(){
        Route::get('/', [CourseController::class, 'index']);
        Route::get('/{id}', [CourseController::class, 'show']);
        Route::post('store', [CourseController::class, 'store']);
        Route::delete('destroy', [CourseController::class, 'destroy']);
        Route::post('update/{id}', [CourseController::class, 'update']);
    });
    //atten
    Route::group(['prefix' => 'atten'], function(){
        Route::get(' ', [AttendanceController::class, 'index']);
        Route::get('/{id} ', [AttendanceController::class, 'show']);
        Route::post('store', [AttendanceController::class, 'store']);
        Route::post('update', [AttendanceController::class, 'update']);
        Route::delete('destroy', [AttendanceController::class, 'destroy']);
    });
    //tahfeez
    Route::group(['prefix' => 'tahfeez'], function(){
        Route::get('', [TahfeezCourseController::class, 'index']);
        Route::get('/{id}', [TahfeezCourseController::class, 'show']);
        Route::post('store',[ TahfeezCourseController::class , 'store']);
        Route::post('update',[ TahfeezCourseController::class , 'update']);
        Route::delete('destroy',[ TahfeezCourseController::class , 'destroy']);
    });
    //student_exam
    Route::group(['prefix' => 'stdExam'], function(){
        Route::get('', [StudentExamController::class, 'index']);
        Route::get('/{id}', [StudentExamController::class, 'show']);
        Route::post('store', [StudentExamController::class, 'store']);
        Route::post('update', [StudentExamController::class, 'update']);
        Route::delete('destroy', [StudentExamController::class, 'destroy']);
    });

    Route::group(['prefix' => 'courseFiles'], function(){
        Route::get('/', [CourseFileController::class, 'index']);
        Route::get('/{id}', [CourseFileController::class, 'show']);
        Route::post('store', [CourseFileController::class, 'store']);
        Route::post('update', [CourseFileController::class, 'update']);
        Route::delete('destory', [CourseFileController::class, 'destory']);
    });

    // Authentication:
    Route::group(['prefix' => 'students'], function(){
        Route::post('/login'  , [StudentAuthController::class , 'login']);
        Route::middleware('auth:sanctum')->post('/logout' , [StudentAuthController::class , 'logout']);
    });

    Route::group(['prefix' => 'instructors'], function(){
        Route::post('/login'  , [InstructorAuthController::class , 'login']);
        Route::middleware('auth:sanctum')->post('/logout' , [InstructorAuthController::class , 'logout']);
    });

    // Route::middleware(['auth:sanctum' ,'role:student'])->get('students/dashboard', function(){
    //     return ['message' => 'student Dashboard'];
    // });

    // Route::middleware(['auth:sanctum' ,'role:instructor'])->get('instructors/dashboard', function(){
    //     return ['message' => 'instructor Dashboard'];
    // });

// Forget and reset password:

// Route::post('/resetPass/{id}', [InstructorAuthController::class, 'resetPassword']);
// Route::get('/forgetPass', [InstructorAuthController::class, 'forgetPassword']);
Route::post('/resetPass', [StudentAuthController::class, 'resetPassword']);
Route::get('/forgetPassword', [StudentAuthController::class, 'forgetPassword']);

});

/*
student and instructor:
    email: moaz@gmail.com
    password: 111111

admin:
    email: admin@gmail.com
    password: 111111

*/
