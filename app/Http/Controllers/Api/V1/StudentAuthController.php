<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\StudentAuthRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
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
            'message' => 'student logout successfuly',
        ];
    }
    // ............
    // ............

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('students')->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Reset link sent.',
                'status' => $status
            ]);
        }

        return response()->json([
            'message' => trans($status),
            'status' => $status
        ]);
    }

    // user click the link that send in email
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed'
        ]);

        $status = Password::broker('students')->reset(
            $request->only(['email', 'token', 'password', 'password_confirmation']),
            function($student, $password){
                $student->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password has been reset.'])
            : response()->json(['message' => 'Reset failed.'], 400);
    }

}
