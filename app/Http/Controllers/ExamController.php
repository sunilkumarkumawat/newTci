<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use DB;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\helper;
use App\Models\ExamDraft;
use App\Models\AssignExam;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

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



    public function getQuestionsByChapterId(Request $request, $chapterId)
    {
        // Fetch questions for the given chapter ID
        $questions = Question::where('chapter_id', $chapterId)
            ->get();

        // Return the view with the questions
        return view('exam.questionsByRequest', compact('questions'));
    }
    public function getQuestionsByTopicId(Request $request, $topicId)
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

        $draft = ExamDraft::where('exam_id', $id)->first();

        $questioningData = [];
        $overviewingData = [];

        if ($draft && $draft->questioningData) {
            $questioningData = json_decode($draft->questioningData, true);
        }
        if ($draft && $draft->overviewingData) {
            $overviewingData = json_decode($draft->overviewingData, true);
        }

        return view(
            'exam.createExam',
            [
                'examDetails' => $examDetails,
                'data' => $id,
                'questioningData' => $questioningData,
                'overviewingData' => $overviewingData
            ]
        );
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
                // 'exams.assign_to',
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

            ->addColumn('assign_to', function ($row) {
                return '<span class="assign-btn text-primary" style="cursor: pointer; text-decoration: underline" data-id="' . $row->id . '" data-name="' . e($row->name) . '">Click here to assign</span>';
            })

            ->addColumn('action', function ($row) {
                return view('exam.partials.actions', compact('row'))->render();
            })
            ->rawColumns(['status', 'created_by', 'assign_to', 'action'])
            ->make(true);
    }


    public function saveGeneratedPaper(Request $request)
    {
        $examData = $request->input('questions');
        $examId = $request->input('exam_id');
        $type = $request->input('type'); // Get type, default to 'default'
        // Create or update the exam
        $draftExam = Exam::updateOrCreate(
            ['id' => $examId ?? null],
            [
                'user_id' => Auth::id(),
                'questions_id' => $type == 'reset' ? null :  $examData,
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Paper saved successfully.',
        ]);
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

            $subjectName = DB::table('all_subjects')
                ->where('id', $subject)
                ->value('name');

            // Store in structured array
            $questionsBySubject[$subjectName] = $questions;
        }

        return view('exam.paperPreview', compact('questionsBySubject'));
    }


    public function draftExam(Request $request)
    {
        $examData = $request->input('draftArray');
        $overViewData = $request->input('overviewMap');
        $examId = $request->input('exam_id');

        $authUser = Auth::guard('web')->check()
            ? Auth::guard('web')->user()
            : (Auth::guard('student')->check() ? Auth::guard('student')->user() : null);
        // // Decode the JSON data
        // $examData = json_decode($examData, true);

        // Create or update the exam
        $draftExam = ExamDraft::updateOrCreate(
            ['id' => $examId ?? null],
            [
                'questioningData' => $examData,
                'overviewingData' => $overViewData,
                'user_id' => $authUser->id,
                'exam_id' => $examId,
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Draft saved successfully.',

        ]);
    }
    public function getQuestionsPreview(Request $request)
    {
        $questionIds = $request->input('questionIds');

        // Normalize to array if comma-separated string
        if (is_string($questionIds)) {
            $questionIds = explode(',', $questionIds);
        }



        // Get questions with subject name using LEFT JOIN
        $questions = DB::table('questions')
            ->leftJoin('all_subjects', 'questions.subject_id', '=', 'all_subjects.id')
            ->whereIn('questions.id', $questionIds)
            ->select('questions.*', 'all_subjects.name as subject_name')
            ->get();

        // Group by subject name
        $questionsBySubject = $questions->groupBy('subject_name');



        return view('exam.paperPreview', compact('questionsBySubject'));
    }
    public function startExam(Request $request, $examId)
    {
        $studentId = Auth::guard('student')->id();

        // Fetch exam details
        $exam = DB::table('exams')
            ->leftJoin('exam_patterns', 'exams.exam_pattern_id', '=', 'exam_patterns.id')
            ->where('exams.id', $examId)
            ->select(
                'exams.*',
                'exam_patterns.name as pattern_name'
            )
            ->first();
        if (!$exam || !$exam->duration_minutes) {
            return response()->json(['error' => 'Exam not found or duration missing'], 404);
        }

        $questionIds = json_decode($exam->questions_id, true);

        if (!$questionIds || !is_array($questionIds)) {
            return response()->json(['error' => 'Invalid or empty question IDs'], 400);
        }

        $durationMinutes = $exam->duration_minutes;

        // Initialize attempt variable
        $finalAttempt = null;

        // Check for existing active attempt
        $latestAttempt = DB::table('exam_attempts')
            ->where('student_id', $studentId)
            ->where('exam_id', $examId)
            ->orderByDesc('attempt_number')
            ->first();

        if ($latestAttempt && $latestAttempt->is_submitted == 0) {
            $startTime = Carbon::parse($latestAttempt->start_time);
            $endTime = Carbon::parse($latestAttempt->end_time);

            // Use existing if still within duration
            if (now()->lessThan($endTime)) {
                $finalAttempt = $latestAttempt;
            }
        }

        // If no valid existing attempt, create a new one
        if (!$finalAttempt) {
            $attemptNumber = $latestAttempt ? $latestAttempt->attempt_number + 1 : 1;
            $startTime = now();
            $endTime = $startTime->copy()->addMinutes($durationMinutes);
            $uniqueId = strtoupper(Str::random(10));

            $attemptId = DB::table('exam_attempts')->insertGetId([
                'student_id' => $studentId,
                'exam_id' => $examId,
                'attempt_number' => $attemptNumber,
                'unique_id' => $uniqueId,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'is_submitted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $finalAttempt = DB::table('exam_attempts')->where('id', $attemptId)->first();
        }

        // Ensure questions are stored (will check inside method for duplicates)
        $this->storeExamQuestions($questionIds, $examId, $finalAttempt->unique_id);


        $examResults = DB::table('exam_results')
            ->where('student_id', $studentId)
            ->where('exam_id', $examId)
            ->where('attempt_unique_id', $finalAttempt->unique_id)
            ->get();


        return view('exam.startExam', ['questionData' => $examResults, 'attempt' => $finalAttempt, 'examData' => $exam]);
    }



    public function storeExamQuestions($questionArray, $examId, $attemptUniqueId)
    {
        $studentId = Auth::guard('student')->id();

        foreach ($questionArray as $subjectId => $questionIds) {

            // Shuffle only the question IDs (values), not the subject ID (key)
            $shuffledQuestions = $questionIds;
            shuffle($shuffledQuestions); // Now values are shuffled

            foreach ($shuffledQuestions as $questionId) {

                // Check if the row already exists
                $exists = DB::table('exam_results')->where([
                    ['exam_id', '=', $examId],
                    ['student_id', '=', $studentId],
                    ['subject_id', '=', $subjectId],
                    ['question_id', '=', $questionId],
                    ['attempt_unique_id', '=', $attemptUniqueId],
                ])->exists();

                if (!$exists) {
                    DB::table('exam_results')->insert([
                        'student_id'        => $studentId,
                        'exam_id'           => $examId,
                        'subject_id'        => $subjectId,
                        'question_id'       => $questionId,
                        'attempt_unique_id' => $attemptUniqueId,
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    ]);
                }
            }
        }
    }


    public function answerkey()
    {
        return view('exam.answerkey');
    }
    public function questionkey()
    {
        return view('exam.questionKey');
    }


    // assign exam
    public function AssignExam(Request $request)
    {
        // Optional: Use validation if needed
        $request->validate([
            'exam_id' => 'required|integer',
            'class_type_id' => 'required|integer',
            'exam_date' => 'required|date',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        // Check for duplicate assignment
        $exists = AssignExam::where('exam_id', $request->exam_id)
            ->where('class_type_id', $request->class_type_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This exam is already assigned to the selected batch.');
        }

        // Save the new assignment
        AssignExam::create([
            'exam_id' => $request->exam_id,
            'class_type_id' => $request->class_type_id,
            'exam_date' => $request->exam_date,
            'duration_minutes' => $request->duration_minutes,
        ]);

        return redirect()->back()->with('success', 'Exam assigned successfully.');
    }
}
