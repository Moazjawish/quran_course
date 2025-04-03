<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Instructor;
use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = Instructor::all();
        return response()->json([
            'instructors' => $instructors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructorRequest $request)
    {
        $validated = $request->all();
        if($request->file('instructorImg'))
        {
            $validated['instructorImg'] = handleFileUpload($request->file("instructorImg"), 'store', "instructorsImg");
        }
        $instructor = Instructor::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'certificate' => $validated['certificate'],
            'instructor_img' => $validated['instructorImg'],
            'phone_number' => $validated['phoneNumber'],
            'quran_memorized_parts' => $validated['quranMemorizedParts'],
            'quran_passed_parts' => $validated['quranPassedParts'],
            'religious_qualifications' => $validated['religiousQualifications'],
            'address' => $validated['address'],
            'birth_date' => $validated['birthDate'],
            'role' => 'instructor',
        ]);
        $token = $instructor->createToken($validated['name']);
        return response()->json([
            'instructor' => $instructor,
            'token' => $token->plainTextToken
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $instructor = Instructor::findOrFail($id);
        if(!$instructor)
        {
            return response()->json([
                'message' => "instructor not found",
            ]);
        }
        return response()->json([
            'instructor' => $instructor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor $instructor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructorRequest $request, $id)
    {
        $validated = $request->all();
        $instructor = Instructor::findOrFail($id);
        if($request->file('instructorImg'))
        {
            $validated['instructorImg'] = handleFileUpload($request->file("instructorImg"), 'update', "instructorsImg", $instructor->instructor_img);
        }
        $instructor->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'certificate' => $validated['certificate'],
            'instructor_img' => $validated['instructorImg'],
            'phone_number' => $validated['phoneNumber'],
            'quran_memorized_parts' => $validated['quranMemorizedParts'],
            'quran_passed_parts' => $validated['quranPassedParts'],
            'religious_qualifications' => $validated['religiousQualifications'],
            'address' => $validated['address'],
            'birth_date' => $validated['birthDate'],
            'role' => 'instructor',
        ]);
        return response()->json(['instructor' => $instructor,
        'message' => 'instructor updated successfuly',
        ]);
    }

    public function getProfile(Request $request)
    {
        $instructor = $request->user();
        return response()->json([
            'instructor' =>  $instructor,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $instructor = $request->user();
        $request->validate([
            'name' => 'sometimes|required',
            'email' => 'regex:/(^([a-zA-Z]+)(\d+)?$)/u|min:7|sometimes|required|email|unique:instructors,email,' . $instructor->id,
        ]);
        $instructor->update($request->only(['name', 'email']));
        return response()->json(['message' => 'Profile updated successfully', 'instructor' => $instructor]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $instructor = Instructor::find($id);
        if (!$instructor) {
            return response()->json(['message' => 'Instructor not found'], 404);
        }
        $instructor->delete();
        return response()->json(['message' => 'Instructor deleted successfully']);
    }
}
