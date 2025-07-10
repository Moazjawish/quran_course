<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRecitationRequest;
use App\Http\Requests\UpdateStudentRecitationRequest;
use App\Models\StudentRecitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentRecitationController extends Controller
{
    public function index()
    {
        $student_recitation = StudentRecitation::all();
        return response()->json([
            'student_recitation' => $student_recitation
        ]);
    }

    public function show($lesson_id)
    {
        // $lesson_recitations = DB::table('student_recitation')
        // ->where('lesson_id', $lesson_id)
        // ->pluck('*')->toArray();

        $lesson_recitations = DB::select('select * from student_recitation where lesson_id = ?',[$lesson_id]);

        // $attended_students = DB::table('attendances')
        // ->where('lesson_id', $lesson_id)
        // ->where('student_attendance', true)
        // ->pluck('student_id')->toArray();

        return response()->json([
            'lesson_recitations' => $lesson_recitations
        ]);
    }

    public function store(StoreStudentRecitationRequest $request ,$id)
    {
        $validated = $request->all();
        $attended_students = DB::table('attendances')
        ->where('lesson_id', $id)
        ->where('student_attendance', true)
        ->pluck('student_id')->toArray();
        $created = [];

        foreach($validated['recitations'] as $recitation)
        {
            if(in_array($recitation['student_id'], $attended_students))
            {
                $created[] = StudentRecitation::create([
                    'lesson_id' => $id,
                    'student_id' => $recitation['student_id'],
                    'recitation_per_page' => $recitation['recitation_per_page'],
                    'recitation_evaluation' => $recitation['recitation_evaluation'],
                ]);
            }
        }

        return response()->json([
            'data' => $created,
            'message' => 'Recitations created for attended students.',
        ],200);
    }

    public function update(UpdateStudentRecitationRequest $request, $lesson_id)
    {
        $validated = $request->all();
        $attended_students = DB::table('attendances')
        ->where('lesson_id', $lesson_id)
        ->where('student_attendance', true)
        ->pluck('student_id')->toArray();

            foreach($validated['recitations'] as $recitation)
            {
                if(in_array($recitation['student_id'], $attended_students))
                {
                    $record = StudentRecitation::where('lesson_id',$lesson_id)->where('student_id',$recitation['student_id'])->first();
                    if($record)
                    {
                        $record->update([
                            'recitation_per_page' => $recitation['recitation_per_page'],
                            'recitation_evaluation' => $recitation['recitation_evaluation'],
                        ]);
                    }
                }
            }
        return response()->json([
            'data' => StudentRecitation::all(),
            'message' => 'Recitations updated for attended students.',
        ],200);
    }

    public function delete($lesson_id)
    {
        $record = StudentRecitation::where('lesson_id',$lesson_id);
        if($record)
        {
            $record->delete();
            return response()->json([
                'message' => 'lesson recitaion was deleted successfully'
            ]);
        }
        return response()->json([
            'message' => 'lesson recitaion was not found'
        ]);
    }
}
