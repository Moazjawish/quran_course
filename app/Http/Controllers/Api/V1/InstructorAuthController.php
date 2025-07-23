<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstructorAuthRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class InstructorAuthController extends Controller
{
    public function login(InstructorAuthRequest $request)
    {
        $validated  = $request->all();
        $instructor = Instructor::where('email', $validated['email'])->first();
        if(!$instructor || !Hash::check($validated['password'], $instructor->password))
        {
            throw ValidationException::withMessages([
                'error' => ['The provided credentials are incorrect.'],
            ]);
        }
        return [
            'instructor' => $instructor,
            'token' => $instructor->createToken('instructor_token' , ['role:instructor'])->plainTextToken,
            'message' => 'login succeessfully'
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return[
            'message' => $request->user()->name .' instructor Logged out successfully',
        ];
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('instructors')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Password reset link sent.'])
            : response()->json(['message' => 'Unable to send reset link.'], 400);
    }

    // user click the link that send in email
    public function reset(ResetPasswordRequest $request)
    {
        $validated = $request->all();
        $status = Password::broker('instructors')->reset(
            $request->only($validated),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password has been reset.'])
            : response()->json(['message' => 'Failed to reset password.'], 400);
    }
}
