<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\V1\StudentCollection;
use App\Http\Resources\V1\StudentResource;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return  new StudentCollection($students);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $validated = $request->all();
        if($request->file('studentImg'))
        {
            $validated['studentImg'] = handleFileUpload($request->file("studentImg"), 'store', 'studentsImg');
        }
        $student = Student::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'certificate' => $validated['certificate'],
            'student_img' => $validated['studentImg'],
            'birth_date' => $validated['birthDate'],
            'quran_memorized_parts' => $validated['quranMemorizedParts'],
            'quran_passed_parts' => $validated['quranPassedParts'],
            'phone_number' => $validated['phoneNumber'],
            'address' => $validated['address'],
            'enroll_date' => $validated['enrollDate'],
            'role' => 'student',
            'reset_password_token' => $validated['resetPasswordToken'],
        ]);
        $token = $student->createToken($validated['name']);
        return [
            'student' => $student,
            'token' => $token->plainTextToken,
        ];

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return new StudentResource($student);
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
        if($request->file('studentImg'))
        {
            $validated['studentImg'] = handleFileUpload($request->file("studentImg"), 'update', 'studentsImg', $student->student_img);
        }
        $student->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'certificate' => $validated['certificate'],
            'student_img' => $validated['studentImg'],
            'birth_date' => $validated['birthDate'],
            'quran_memorized_parts' => $validated['quranMemorizedParts'],
            'quran_passed_parts' => $validated['quranPassedParts'],
            'phone_number' => $validated['phoneNumber'],
            'address' => $validated['address'],
            'enroll_date' => $validated['enrollDate'],
            'role' => 'student',
            'reset_password_token' => $validated['resetPasswordToken'],
        ]);
        return [
            'student' => $student,
            'messsage' => "students updated",
        ];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
    }
}
