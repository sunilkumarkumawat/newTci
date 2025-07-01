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
  public function getChaptersByRequest(Request $request, $classId, $subjectId)
{
    // Step 1: Get all questions (with chapter name)
    $questions = DB::table('questions')
        ->leftJoin('chapters', 'chapters.id', '=', 'questions.chapter_id')
        ->where('questions.class_type_id', $classId)
        ->where('questions.subject_id', $subjectId)
        ->select('questions.*', 'chapters.name as chapter_name')
        ->get();

    // Step 2: Group and count manually
    $groupedData = [];

    foreach ($questions as $q) {
        $chapterId = $q->chapter_id ?? 0;
        $chapterName = $q->chapter_name ?? 'Unassigned';

        // Initialize if not already
        if (!isset($groupedData[$chapterId])) {
            $groupedData[$chapterId] = [
                'chapter_id' => $chapterId,
                'chapter_name' => $chapterName,
                'objective_count' => 0,
                'numeric_count' => 0,
                'total_questions' => 0,
                'objective_question_ids' => [],
                'numeric_question_ids' => [],
            ];
        }

        // Count and collect IDs by question type
        if ($q->question_type_id == 1) {
            $groupedData[$chapterId]['objective_count']++;
            $groupedData[$chapterId]['objective_question_ids'][] = $q->id;
        } elseif ($q->question_type_id == 2) {
            $groupedData[$chapterId]['numeric_count']++;
            $groupedData[$chapterId]['numeric_question_ids'][] = $q->id;
        }

        $groupedData[$chapterId]['total_questions']++;
    }

    // Convert to indexed array & format question IDs
    $chapterStats = array_map(function ($item) {
        $item['objective_question_ids'] = implode(',', $item['objective_question_ids']);
        $item['numeric_question_ids'] = implode(',', $item['numeric_question_ids']);
        return $item;
    }, array_values($groupedData));

    return view('exam.chapterList', [
        'questions' => $questions,
        'chapterStats' => $chapterStats,
        'classId' => $classId,
        'subjectId' => $subjectId
    ]);
}



    public function getQuestionsByChapterId(Request $request,$chapterId)
    {
        // Fetch questions for the given chapter ID
        $questions = Question::where('chapter_id', $chapterId)
            ->get();

        // Return the view with the questions
        return view('exam.questionsByRequest', compact('questions'));
    }
    public function getQuestionsByTopicId(Request $request,$topicId)
    {
        // Fetch questions for the given chapter ID
        $questions = Question::where('topic_id', $topicId)
            ->get();

        // Return the view with the questions
        return view('exam.questionsByRequest', compact('questions'));
    }
    
   public function getSubTopicsByRequest(Request $request, $chapterId)
{
    // Step 1: Get all questions with topic name
    $questions = DB::table('questions')
        ->leftJoin('topics', 'topics.id', '=', 'questions.topic_id')
        ->where('questions.chapter_id', $chapterId)
        ->select('questions.*', 'topics.name as topic_name')
        ->get();

    // Step 2: Group and count manually
    $groupedData = [];

    foreach ($questions as $q) {
        $topicId = $q->topic_id ?? 0;
        $topicName = $q->topic_name ?? 'Unassigned';

        if (!isset($groupedData[$topicId])) {
            $groupedData[$topicId] = [
                'chapter_id' => $topicId,
                'topic_id' => $topicId,
                'topic_name' => $topicName,
                'objective_count' => 0,
                'numeric_count' => 0,
                'total_questions' => 0,
                'objective_question_ids' => [],
                'numeric_question_ids' => [],
            ];
        }

        if ($q->question_type_id == 1) {
            $groupedData[$topicId]['objective_count']++;
            $groupedData[$topicId]['objective_question_ids'][] = $q->id;
        } elseif ($q->question_type_id == 2) {
            $groupedData[$topicId]['numeric_count']++;
            $groupedData[$topicId]['numeric_question_ids'][] = $q->id;
        }

        $groupedData[$topicId]['total_questions']++;
    }

    // Format question IDs as comma-separated strings
    $topicStats = array_map(function ($item) {
        $item['objective_question_ids'] = implode(',', $item['objective_question_ids']);
        $item['numeric_question_ids'] = implode(',', $item['numeric_question_ids']);
        return $item;
    }, array_values($groupedData));

    // Return view with topic statistics
    return view('exam.subTopicsByChapter', [
        'topicStats' => $topicStats,
        'chapterId' => $chapterId
    ]);
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

        return view('exam.paperPreview', compact('questionsBySubject'));
    }


    public function startExam(){
        return view('exam.startExam');
    }

    public function answerkey(){
        return view('exam.answerkey');
    }
    public function questionkey(){
        return view('exam.questionKey');
    }

}

