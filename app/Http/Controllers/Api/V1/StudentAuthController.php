<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\StudentAuthRequest;
use App\Mail\ResetPasswordJob;
use App\Models\Instructor;
use App\Models\PasswordReset;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class StudentAuthController extends Controller
{
    public function login(StudentAuthRequest $request)
    {
        $validated = $request->all();
        $student = Student::where('email', $validated['email'])->first();
        if(!$student || !Hash::check($validated['password'], $student->password))
        {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return [
            'student' => $student,
            'token' => $student->createToken('student_token', ['rule:student'])->plainTextToken,
            'message' => 'Login successfully'
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return [
            'message' => 'user logout successfuly',
        ];
    }



    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $validated = $request->all();
        $student = Student::where('email', $validated['email'])->first();
        if(!$student)
        {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $resetPasswordToken = str_pad(random_int(1,9000),4,'0');
        Mail::to($student->email)->send(
            new ResetPasswordJob($resetPasswordToken)
        );
        // the user must has only one resetPassword request.
        if(!PasswordReset::where('email', $validated['email'])->first())
        {
            $studentReset = PasswordReset::create([
                'email' => $request->email,
                'token' => $resetPasswordToken
            ]);
        }
        else
        {
            $student->update([
                'email' => $request->email,
                'token' => $request->token
            ]);
        }

        return [
            'student' => $student,
        ];
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $validated = $request->all();
        $instructor =Instructor::where('email', $validated['email'])->first();
        if(!$instructor)
        {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $resetRequest = PasswordReset::where('email', $validated['email'])->first();
        if(!$resetRequest || $resetRequest->token != $request->token)
        {
            throw ValidationException::withMessages([
                'error' => ['The provided credentials are incorrect.'],
            ]);
        }
        $studentReset = $instructor->update([
            'password' => Hash::make($validated['password'])
        ]);
        $resetRequest->delete();
        $instructor->tokens()->delete();

        $token = $instructor->createToken("auth_user")->plainTextToken;
        return [
            'instructor' => $instructor,
            'token' => $token,
            "status" => 200
        ];
    }
}
