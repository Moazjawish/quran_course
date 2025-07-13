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
    StudentRecitationController,
};

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::group(['prefix' => 'v1',  'middleware' => 'auth:sanctum'], function(){
Route::group(['prefix' => 'v1'], function(){

    // students
    Route::group(['prefix' => 'students'] ,function(){
        Route::get('', [StudentController::class, 'index']);
        Route::get('/{id}', [StudentController::class, 'show']);

    // });
        // Route::middleware(['role:admin'])->prefix('students')->group(function(){
            Route::post('store', [StudentController::class, 'store']);
            Route::delete('delete/{id}', [StudentController::class, 'destroy']);
            Route::post('update/{id}', [StudentController::class, 'update']);
            });

    Route::middleware(['role:student'])->prefix('students')->group(function(){
        Route::get('/profile', [StudentController::class, 'getProfile']);
        Route::post('/updateProfile', [StudentController::class, 'updateProfile']);
    });


    //instructors
    Route::middleware(['restrict_student'])->prefix('instructors')->group(function(){
        Route::get('', [InstructorController::class, 'index']);
        Route::get('/{id}', [InstructorController::class, 'show']);
    });

    // Route::middleware(['role:admin'])->prefix('instructors')->group(function(){
    Route::prefix('instructors')->group(function(){
        Route::post('store', [InstructorController::class, 'store']);
        Route::delete('delete/{id}', [InstructorController::class,'destroy']);
        Route::post('update/{id}',[ InstructorController::class, 'update']);
    });

    Route::middleware(['role:instructor'])->prefix('instructors')->group(function(){
        Route::get('/profile', [InstructorController::class, 'getProfile']);
        Route::post('/updateProfile', [InstructorController::class, 'updateProfile']);
    });

    //lessons
    Route::group(['prefix' => 'lessons'] ,function(){
        Route::get('/',[ LessonController::class, 'index']);
        Route::get('/{id}',[ LessonController::class, 'show']);
        Route::post('store', [LessonController::class, 'store']);
        Route::delete('delete/{id}', [LessonController::class ,'destroy']);
        Route::post('update/{id}', [LessonController::class, 'update']);
        Route::get('students/{id}',[LessonController::class, 'LessonStudents']);
    });

    //exams
    Route::group(['prefix' => 'exams'], function(){
        Route::get('', [ExamController::class, 'index']);
        Route::get('/{id}', [ExamController::class, 'show']);
        Route::post('store', [ExamController::class, 'store']);
        Route::post('update/{id}',[ExamController::class,'update']);
        Route::delete('delete/{id}', [ExamController::class, 'destroy']);
    });
    //courses
    Route::group(['prefix' => 'courses'], function(){
        Route::get('/', [CourseController::class, 'index']);
        Route::get('/{id}', [CourseController::class, 'show']);
        Route::post('store', [CourseController::class, 'store']);
        Route::delete('delete/{id}', [CourseController::class, 'destroy']);
        Route::post('update/{id}', [CourseController::class, 'update']);
        Route::post('/{id}/students', [CourseController::class, 'syncStudents']);
    });

    //atten
    Route::group(['prefix' => 'atten'], function(){
        Route::get('', [AttendanceController::class, 'index']);
        Route::get('/{id} ', [AttendanceController::class, 'show']);
        Route::post('store', [AttendanceController::class, 'store']);
        Route::post('update/{id}', [AttendanceController::class, 'update']);
        Route::delete('destroy/{id}', [AttendanceController::class, 'destroy']);
        Route::post('updateStudent/{lesson_id}/{student_id}', [AttendanceController::class, 'updateStudentAttendance']);
    });

    //student_exam
    Route::group(['prefix' => 'stdExam'], function(){
        Route::get('', [StudentExamController::class, 'index']);
        Route::get('/{id}', [StudentExamController::class, 'show']);
        Route::post('store', [StudentExamController::class, 'store']);
        Route::post('update/{id}', [StudentExamController::class, 'update']);
        Route::delete('destroy/{id}', [StudentExamController::class, 'destroy']);
    });

    Route::group(['prefix' => 'courseFiles'], function(){
        Route::get('/', [CourseFileController::class, 'index']);
        Route::get('/{id}', [CourseFileController::class, 'show']);
        Route::post('store', [CourseFileController::class, 'store']);
        Route::post('update/{id}', [CourseFileController::class, 'update']);
        Route::delete('delete/{id}', [CourseFileController::class, 'destroy']);
    });

    Route::group(['prefix' => 'recitation'],function(){
        Route::get('/',[StudentRecitationController::class, 'index']);
        Route::get('/{lesson_id}',[StudentRecitationController::class, 'show']);
        Route::post('store/{lesson_id}',[StudentRecitationController::class, 'store']);
        Route::post('update/{lesson_id}',[StudentRecitationController::class, 'update']);
        Route::delete('delete/{lesson_id}',[StudentRecitationController::class, 'delete']);
    });
});


// Authentication:
Route::group(['prefix' => 'v1'], function(){
    Route::group(['prefix' => 'students'], function(){
        Route::post('/login' , [StudentAuthController::class , 'login']);
        Route::middleware('auth:sanctum')->post('/logout' , [StudentAuthController::class , 'logout']);

        Route::post('/forgot-password', [StudentAuthController::class, 'sendResetLinkEmail']);
        Route::post('/reset-password', [StudentAuthController::class, 'reset']);
    });

Route::group(['prefix' => 'instructors'], function(){
        Route::post('/login' , [InstructorAuthController::class , 'login']);
        Route::middleware('auth:sanctum')->post('/logout' , [InstructorAuthController::class , 'logout']);

        Route::post('forgot-password',[InstructorAuthController::class, 'sendResetLinkEmail']);
        Route::post('reset-password', [InstructorAuthController::class, 'reset']);
    });

});




/*
student
    email: moazsham9@gmail.com
    password: 111111

instructor:
    email: moazoo@gmail.com
    password: 111111

admin:
    email: admin@gmail.com
    password: 111111
    */
