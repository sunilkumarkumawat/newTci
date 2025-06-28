<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use DB;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\helper;

class ExamController extends Controller 
{
    public function dashboard()
    {
        return view('exam.dashboard');
    }
    public function examCreate()
    {
        return view('exam.examCreate');
    }
    public function examList()
    {
        return view('exam.examList');
    }
    public function getQuestionsByRequest(Request $request, $classId, $subjectId)
    {
        // Fetch questions based on classId and subjectId
        $questions = DB::table('questions')
            ->where('class_type_id', $classId)
            ->where('subject_id', $subjectId)
            ->get();

        return view('exam.questionList', ['questions' => $questions, 'classId' => $classId, 'subjectId' => $subjectId]);
    }
    public function createExam(Request $request)
    {

        $id = $request->query('query');

        $examDetails = Exam::leftJoin('exam_types', 'exams.exam_type_id', '=', 'exam_types.id')
            ->leftJoin('exam_patterns', 'exams.exam_pattern_id', '=', 'exam_patterns.id')
            ->select('exams.*', 'exam_types.name as exam_type_name', 'exam_patterns.name as exam_pattern_name')
            ->where('exams.id', $id)
            ->first();





        return view('exam.createExam', ['examDetails' => $examDetails, 'data' => $id]);
    }
    public function examData(Request $request)
    {
        $filters = $request->filterable_columns ?? [];

        $query = DB::table('exams')
            ->leftJoin('users', function ($join) {
                $join->on('exams.user_id', '=', 'users.id')
                    ->whereNull('users.deleted_at'); // optional if users table uses soft deletes
            })
            ->select(
                'exams.id',
                'exams.name',
                'exams.user_id',
                'exams.status',
                'exams.created_at',
                'exams.deleted_at',
                'users.name as created_by' // optional: to display in the datatable
            );
        foreach ($filters as $filter) {
            $name = $filter['name'] ?? null;
            $value = $filter['value'] ?? null;

            if ($name && $value !== null && $value !== '') {
                if ($name === 'created_from') {
                    $query->whereDate('exams.created_at', '>=', $value);
                } elseif ($name === 'created_to') {
                    $query->whereDate('exams.created_at', '<=', $value);
                } else {
                    $query->where("exams.$name", $value);
                }
            }
        }

        return DataTables::of($query)
            ->addIndexColumn()

            ->editColumn('created_by', function ($row) {
                if ($row->user_id == 1) {
                    return '<span class="badge bg-info">Admin</span>';
                }

                // Use created_by_name if available, otherwise show fallback
                return '<span class="badge bg-secondary">' . ($row->created_by ?? 'Unknown') . '</span>';
            })
            ->editColumn('status', function ($row) {
                switch ($row->status) {
                    case 0:
                        return '<span class="badge bg-warning">Ideal</span>';
                    case 1:
                        return '<span class="badge bg-success">Active</span>';
                    case 2:
                        return '<span class="badge bg-danger">Inactive</span>';
                    default:
                        return '<span class="badge bg-secondary">Unknown</span>';
                }
            })
            ->editColumn('created_at', function ($item) {
                return \Carbon\Carbon::parse($item->created_at)->format('d-m-Y');
            })
            ->addColumn('action', function ($row) {
                return view('exam.partials.actions', compact('row'))->render();
            })
            ->rawColumns(['status', 'created_by', 'action'])
            ->make(true);
    }


    public function PaperPreview(Request $request)
    {
        $jsonData = $request->input('questionIds');


        // Decode subject => [question_ids] array
        $questionIdsBySubject = json_decode($jsonData, true);

        $questionsBySubject = [];

        foreach ($questionIdsBySubject as $subject => $questionIds) {
            // Fetch questions for this subject and only the requested IDs
            $questions = Question::whereIn('id', $questionIds)
                ->get();

            // Store in structured array
            $questionsBySubject[$subject] = $questions;
        }

        return view('common.questionPreview', compact('questionsBySubject'));
    }


    // public function PaperPreview(Request $request)
    // {
    //     // Decode JSON from the request
    //     $questionData = json_decode($request->questionIds, true);

    //     // Safe fallback if decoding fails
    //     if (!is_array($questionData)) {
    //         return response()->json(['error' => 'Invalid question data'], 422);
    //     }

    //     // Prepare questions by subject
    //     $questionsBySubject = [];

    //     foreach ($questionData as $subject => $ids) {
    //         $questions = Question::whereIn('id', $ids)->get();
    //         $questionsBySubject[$subject] = $questions;
    //     }

    //     // Send view with valid data
    //     return view('common.questionPreview', [
    //         'questionsBySubject' => $questionsBySubject
    //     ]);
    // }



    // public function PaperPreview(Request $request)
    // {
    //     $questionsBySubject = [];

    //     if ($request->has('questionIds')) {
    //         $questionData = json_decode($request->questionIds, true);

    //         if (is_array($questionData)) {
    //             foreach ($questionData as $subject => $ids) {
    //                 if (is_array($ids) && !empty($ids)) {
    //                     $questions = Question::whereIn('id', $ids)->get();
    //                     $questionsBySubject[$subject] = $questions;
    //                 }
    //             }
    //         }
    //     }

    //     return view('common.questionPreview', [
    //         'questionsBySubject' => $questionsBySubject
    //     ]);
    // }
}
