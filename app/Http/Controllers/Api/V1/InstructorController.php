<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Instructor;
use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;
use App\Http\Resources\V1\InstructorCollection;
use App\Http\Resources\V1\InstructorResource;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = Instructor::all();
        return new InstructorCollection($instructors);
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
        Instructor::create([
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
            'is_admin' => $validated['isAdmin'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {
        return new InstructorResource($instructor);
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
    public function update(UpdateInstructorRequest $request, Instructor $instructor)
    {
        $validated = $request->all();
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
            'is_admin' => $validated['isAdmin'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor)
    {
        $instructor->delete();
    }
}
