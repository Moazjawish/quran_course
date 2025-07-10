<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\V1\StudentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json([
            'students' => StudentResource::collection($students)
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() {}
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $validated = $request->all();
        if($request->file('student_img'))
        {
            $validated['student_img'] = handleFileUpload($request->file("student_img"), 'store', 'studentsImg');
        }
        $student = Student::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'certificate' => $validated['certificate'],
            'student_img' => $validated['student_img'],
            'birth_date' => $validated['birth_date'],
            'quran_memorized_parts' => $validated['quran_memorized_parts'],
            'quran_passed_parts' => $validated['quran_passed_parts'],
            'phone_number' => $validated['phone_number'],
            'address' => $validated['address'],
            'enroll_date' => $validated['enroll_date'],
            'role' => 'student',
            'reset_password_token' => $validated['reset_password_token'],
        ]);
        $token = $student->createToken($validated['name']);
        return response()->json([
            'student' => new StudentResource($student),
            'token' => $token->plainTextToken,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        if(!$student)
        {
            return response()->json(['message' => 'student not found']);
        }
        else
        {
            return response()->json([
                'student' => new StudentResource($student),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $validated = $request->all();
        $student = Student::findOrFail($id);
        if($request->file('student_img'))
        {
            $validated['student_img'] = handleFileUpload($request->file("student_img"), 'update', 'studentsImg', $student->student_img);
        }
        $student->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'certificate' => $validated['certificate'],
            'student_img' => $validated['student_img'],
            'birth_date' => $validated['birth_date'],
            'quran_memorized_parts' => $validated['quran_memorized_parts'],
            'quran_passed_parts' => $validated['quran_passed_parts'],
            'phone_number' => $validated['phone_number'],
            'address' => $validated['address'],
            'enroll_date' => $validated['enroll_date'],
            'role' => 'student',
            'reset_password_token' => $validated['reset_password_token'],
        ]);
        return response()->json([
            'student' => new StudentResource($student),
            'messsage' => "student updated",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        if(!$student)
        {
            return response()->json(['message' => 'student not found']);
        }
        else
        {
            $student->delete();
            return response()->json(['message' => 'student deleted successfully']);
        }
    }

    public function updateProfile(Request $request)
    {
        $student = $request->user();
        $request->validate([
            'name' => 'sometimes|required',
            'email' => 'regex:/(^([a-zA-Z]+)(\d+)?$)/u|min:7|sometimes|required|email|unique:students,email,' . $student->id,
        ]);
        $student->update($request->only(['name', 'email']));

        return response()->json([
            'student' => $student,
            'message' => "student updated successfully"
        ]);
    }

    public function getProfile(Request $request)
    {
        $student = $request->user();
        return response()->json([
            'student' => new StudentResource($student),
        ]);
    }

}
