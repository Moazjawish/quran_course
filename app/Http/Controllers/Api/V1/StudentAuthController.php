<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\StudentAuthRequest;
use App\Mail\ResetPasswordJob;
use App\Models\Instructor;
use App\Models\PasswordReset;
use App\Models\Student;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Mockery\Generator\StringManipulation\Pass\Pass;

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
        $request->student()->tokens()->delete();
        return [
            'message' => 'student logout successfuly',
        ];
    }

    public function forgetPassword(Request $request)
    {
        $request->validate(['email' => 'email']);
        $student = Student::where('email' , $request->email)->first();
        if(!$student)
        {
            throw ValidationException::withMessages([
                'message' => "student not found"
            ]);
        }
        $status = Password::sendResetLink($request->only(['email']));
        return $status === Password::ResetLinkSent
        ? response()->json(['status' => __($status)])
        : response()->json(['email' =>  __($status)]);

        // $token = Str::random(64);
        // DB::table('password_reset_tokens')->updateOrInsert(
        //     [
        //         'email' => $request->email
        //     ],
        //     [
        //         'token' => $token,
        //         "created_at" => Carbon::now()
        //     ]
        // );
        //     $resetUrl = url("/api/reset-password?token=$token&email=" . urlencode($request->email));
        //     Mail::to($request->email)->send(new ResetPasswordJob($resetUrl));
        //     response()->json(["message" => "Link sent successfully"]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        $status = Password::reset($request->only(['email','token','password','password_confirmation']),
        function (Student $student, String $password){
            $student->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
            $student->save();
            event(new PasswordReset([$student]));
        }
    );
    return $status === Password::PASSWORD_RESET
    ? response()->json([
        'message' => trans($status),
    ])
    : response()->json([
        'message' => trans($status),
    ], 400);



        // $record = DB::table('password_reset_tokens')
        //     ->where('email', $request->email)
        //     ->first();

        // if (!$record || !Hash::check($request->token, $record->token)) {
        //     return response()->json(['message' => 'Invalid or expired token'], 400);
        // }

        // $student = Student::where('email', $request->email)->first();
        // $student->password = Hash::make($request->password);
        // $student->save();

        // // Clean up
        // DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // return response()->json(['message' => 'Password reset successful']);

    }

    public function emailVerify($student_id, Request $request)
    {
        if (!$request->hasValidSignature()) {
            return response()->json([
                'message' => 'Invalid or expired verification code.',
            ], 400);
        }

        $student = Student::findOrFail($student_id);

        if (!$student) {
            return response()->json([
                'message' => 'student not found.',
            ], 400);
        }

        if (!$student->hasVerifiedEmail()) {
            $student->markEmailAsVerified();
            return response()->json([
                'message' => 'Email address successfully verified',
                'student' => $student,
            ]);
        }

        return response()->json([
            'message' => 'Email address already verified.',
        ], 400);
    }

    public function resendEmailVerificationMail(Request $request)
    {
        $student_id = $request->input('student_id');

        $student = Student::findOrFail($student_id);

        if (!$student) {
            return response()->json([
                'message' => 'student not found.',
            ], 400);
        }

        if ($student->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already verified.',
            ], 400);
        }

        $student->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Email verification link sent to your email address',
        ]);
    }


}
