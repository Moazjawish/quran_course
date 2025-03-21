<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstructorAuthRequest;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            'message' => 'instructor Logged out successfully',
        ];
    }
}
