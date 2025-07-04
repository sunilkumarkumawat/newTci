<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use App\Models\library\Library;
use App\Models\Branch;
use App\Models\Setting;
use App\Models\User;
use App\Models\Sessions;
use App\Models\Sidebar;
use App\Models\PaymentMode;
use App\Models\Question;
use App\Models\Exam;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;

class Helper
{

    public static function getPermissions()
    {
        $user = Auth::user() ?? Auth::guard('student')->user();

        if (!$user) {
            return [];
        }

        $userId = $user->id;
        $roleId = $user->role_id;

        // Step 1: Try user_permissions
        $userPermissions = DB::table('user_permissions')
            ->where('user_id', $userId)
            ->pluck('permission')
            ->toArray();

        if (!empty($userPermissions)) {
            return $userPermissions;
        }

        // Step 2: Fallback to role_permissions
        $rolePermissions = DB::table('role_permissions')
            ->where('role_id', $roleId)
            ->pluck('permission')
            ->toArray();

        return !empty($rolePermissions) ? $rolePermissions : [];
    }
    public static function getSidebar()
    {
        $allPermissions = self::getPermissions();

        // Normalize permission list (lowercase)
        $allowedPermissions = array_map('strtolower', $allPermissions);

        $sidebarMenu = [
            // [
            //     'title' => 'Dashboard',
            //     'className' => 'dashboard.view',
            //     'status' => true,
            //     'icon' => 'fa fa-desktop',
            //     'route' => 'dashboard',
            // ],
            [
                'title' => 'User Management',
                'className' => 'user_management',
                'status' => true,
                'icon' => 'fa fa-users',
                'subItems' => [
                    [
                        'title' => 'Add User',
                        'className' => 'user_management.add',
                        'status' => true,
                        'route' => 'userAdd',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'View User',
                        'className' => 'user_management.view',
                        'status' => true,
                        'route' => 'userView',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Id & Password',
                        'className' => 'user_management.add',
                        'status' => true,
                        'route' => 'userPassword',
                        'icon' => 'fa fa-circle',
                    ],
                ],
            ],
            [
                'title' => 'Student Management',
                'className' => 'student_management',
                'status' => true,
                'icon' => 'fa fa-person',
                'subItems' => [
                    [
                        'title' => 'Batch',
                        'className' => 'student_management.add',
                        'status' => true,
                        'route' => 'batches',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Add New Student',
                        'className' => 'student_management.add',
                        'status' => true,
                        'route' => 'studentAdd',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'View Students',
                        'className' => 'student_management.view',
                        'status' => true,
                        'route' => 'studentView',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Id & Password',
                        'className' => 'student_management.add',
                        'status' => true,
                        'route' => 'studentIdPassword',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Student Test History',
                        'className' => 'student_management.add',
                        'status' => true,
                        'route' => 'studentTestHistory',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Student Fee Status',
                        'className' => 'student_management.add',
                        'status' => true,
                        'route' => 'studentFeesStatus',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Performance Report',
                        'className' => 'student_management.add',
                        'status' => true,
                        'route' => 'performanceReport',
                        'icon' => 'fa fa-circle',
                    ],

                ],
            ],
            [
                'title' => 'Question Bank',
                'className' => 'question_bank',
                'status' => true,
                'icon' => 'fa fa-check-square',
                'subItems' => [

                    [
                        'title' => 'Dashboard',
                        'className' => 'dashboard.view',
                        'status' => true,
                        'icon' => 'fa fa-desktop',
                        'route' => 'questionDashboard',
                    ],
                    [
                        'title' => 'Subjects',
                        'className' => 'question_bank.add',
                        'status' => true,
                        'route' => 'subject',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Chapter',
                        'className' => 'question_bank.add',
                        'status' => true,
                        'route' => 'chapter',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Topics',
                        'className' => 'question_bank.add',
                        'status' => true,
                        'route' => 'topics',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Tags',
                        'className' => 'question_bank.add',
                        'status' => true,
                        'route' => 'tags',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Add New Question',
                        'className' => 'question_bank.add',
                        'status' => true,
                        'route' => 'questions',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Question List',
                        'className' => 'question_bank.view',
                        'status' => true,
                        'route' => 'questionView',
                        'icon' => 'fa fa-circle',
                    ],
                ],
            ],
            [
                'title' => 'Exam Management',
                'className' => 'exam_management',
                'status' => true,
                'icon' => 'fa fa-calendar-check',
                'subItems' => [
                    [
                        'title' => 'Create New Exam',
                        'className' => 'exam_management.add',
                        'status' => true,
                        'route' => 'exam/create',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Exam List',
                        'className' => 'exam_management.list',
                        'status' => true,
                        'route' => 'exam/list',
                        'icon' => 'fa fa-circle',
                    ],
                ],
            ],
            [
                'title' => 'Result Analysis',
                'className' => 'result_analysis',
                'status' => true,
                'icon' => 'fa fa-calendar-check',
                'subItems' => [
                    [
                        'title' => 'Overview Dashboard',
                        'className' => 'result_analysis.view',
                        'status' => true,
                        'route' => 'resultAnalysis/dashboard',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Test-Wise Report',
                        'className' => 'result_analysis.report',
                        'status' => true,
                        'route' => 'test-wise-report',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Student-Wise Report',
                        'className' => 'result_analysis.report',
                        'status' => true,
                        'route' => 'student-wise-report',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Subject-Wise Report',
                        'className' => 'result_analysis.report',
                        'status' => true,
                        'route' => 'subject-wise-report',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Batch-Wise Comparison',
                        'className' => 'result_analysis.report',
                        'status' => true,
                        'route' => 'batch-wise-comparison',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Time-Based Performance',
                        'className' => 'result_analysis.report',
                        'status' => true,
                        'route' => 'time-based-performance',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Exam Analysis',
                        'className' => 'result_analysis.report',
                        'status' => true,
                        'route' => 'examAnalysis',
                        'icon' => 'fa fa-circle',
                    ],
                ],
            ],
            [
                'title' => 'Master Management',
                'className' => 'master_management',
                'status' => true,
                'icon' => 'fa fa-sitemap',
                'subItems' => [

                    [
                        'title' => 'Role',
                        'className' => 'master_management.role',
                        'status' => true,
                        'route' => 'role',
                        'icon' => 'fa fa-circle',
                    ],
                ],
            ],
            [
                'title' => 'Test Schedular',
                'className' => 'test_schedular',
                'status' => true,
                'icon' => 'fa fa-sitemap',
                'subItems' => [

                    [
                        'title' => 'Create New Test',
                        'className' => 'test_schedular.createNewTest',
                        'status' => true,
                        'route' => 'create-new-test',
                        'icon' => 'fa fa-circle',
                    ],
                ],
            ],
            [
                'title' => 'Student Feedback',
                'className' => 'student_feedback',
                'status' => true,
                'icon' => 'fa fa-sitemap',
                'subItems' => [

                    [
                        'title' => 'All Feedback/Doubts Overview',
                        'className' => 'student_feedback.allFeedbackDoubt',
                        'status' => true,
                        'route' => 'allFeedbackDoubt',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'View Doubts/Feedback Detail',
                        'className' => 'student_feedback.viewDoubt',
                        'status' => true,
                        'route' => 'viewDoubt',
                        'icon' => 'fa fa-circle',
                    ],
                ],
            ],
            [
                'title' => 'Institute Management',
                'className' => 'institute_management',
                'status' => true,
                'icon' => 'fa fa-cog',
                'subItems' => [
                    [
                        'title' => 'View Setting',
                        'className' => 'institute_management.setting',
                        'status' => true,
                        'route' => 'setting',
                        'icon' => 'fa fa-circle',
                    ],
                ],
            ],
            [
                'title' => 'Report & Export',
                'className' => 'report_management',
                'status' => true,
                'icon' => 'fa-solid fa-file-lines',
                'subItems' => [
                    [
                        'title' => 'Faculty Reports',
                        'className' => 'faculty_report',
                        'status' => true,
                        'route' => 'facultyReport',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Time Analysis',
                        'className' => 'timeanalysis',
                        'status' => true,
                        'route' => 'timeAnalysis',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Feedback & Doubt',
                        'className' => 'feedback_doubt',
                        'status' => true,
                        'route' => 'doubtSolution',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Test & Attendence',
                        'className' => 'attendence_report',
                        'status' => true,
                        'route' => 'attendence_report',
                        'icon' => 'fa fa-circle',
                    ],
                    [
                        'title' => 'Custom Report',
                        'className' => 'custom_report',
                        'status' => true,
                        'route' => 'customReport',
                        'icon' => 'fa fa-circle',
                    ],
                ],
            ],
        ];

        // Filter based on permissions for non-admin users
        // Detect current logged-in user safely
        $currentUser = Auth::guard('web')->check()
            ? Auth::guard('web')->user()
            : (Auth::guard('student')->check() ? Auth::guard('student')->user() : null);

        // Apply permission filtering only if user has role_id != 1
        if ($currentUser && isset($currentUser->role_id) && $currentUser->role_id != 1) {
            foreach ($sidebarMenu as $key => &$menu) {
                // Filter subItems if present
                if (isset($menu['subItems'])) {
                    $menu['subItems'] = array_filter($menu['subItems'], function ($sub) use ($allowedPermissions) {
                        return in_array(strtolower($sub['className']), $allowedPermissions);
                    });

                    // If no subItems left, unset parent
                    if (empty($menu['subItems'])) {
                        unset($sidebarMenu[$key]);
                    }
                } else {
                    // If no subItems, check main className
                    if (!in_array(strtolower($menu['className']), $allowedPermissions)) {
                        unset($sidebarMenu[$key]);
                    }
                }
            }
        }

        return array_values($sidebarMenu);
    }



    public static function getPaymentMode()
    {
        $getPaymentMode = PaymentMode::orderBy('id', 'DESC');
        $getPaymentMode = $getPaymentMode->get();
        return $getPaymentMode;
    }
    public static function getBranches()
    {
        $getBranch = Branch::orderBy('id', 'DESC');
        $getBranch = $getBranch->get();
        return $getBranch;
    }

    public static function getModalData($modal, $dependentId = null, $foreignKey = null)
    {




        $baseModalName = $modal;
        // Build fully qualified class name if not already
        if (!str_contains($modal, '\\')) {
            $modal = 'App\\Models\\' . $modal;
        }




        // Check if class exists
        if (!class_exists($modal)) {
            return [];
        }


        try {


            if ($baseModalName == 'AssignedSubjects') {

                $query = $modal::leftJoin('all_subjects', 'subject.subject_id', '=', 'all_subjects.id')
                    ->where('subject.' . $foreignKey, $dependentId);

                // Build id => name array (assumes 'id' and 'name' fields exist)
                return $query->pluck('all_subjects.name', 'all_subjects.id')->toArray();
            } elseif ($baseModalName == 'Subject' && $foreignKey == 'exam_pattern_id') {

                $query = $modal::where(function ($q) use ($dependentId) {
                    $q->whereRaw("FIND_IN_SET(?, exam_pattern_id)", [$dependentId])
                        ->orWhere('exam_pattern_id', '=', (string) $dependentId);
                });

                return $query->pluck('name', 'id')->toArray();
            } else {
                $query = $modal::query();
                // If a dependent ID is provided, apply where condition
                if ($dependentId !== null) {
                    $query->where($foreignKey, $dependentId);
                }
                // Build id => name array (assumes 'id' and 'name' fields exist)
                return $query->pluck('name', 'id')->toArray();
            }
        } catch (\Exception $e) {
            // Optional: log error
            return [];
        }
    }

    public static function getLibrary()
    {
        $getLibrary = Library::orderBy('id', 'DESC');
        $getLibrary = $getLibrary->get();
        return $getLibrary;
    }

    public static function getSetting()
    {

        $setting = Setting::where('branch_id', Session::get('branch_id'))->with('Account')->with('City')->with('Country')->with('State')->with('Account')->get()->first();

        if (empty($setting)) {
            $setting = Setting::where('branch_id', 1)->with('Account')->with('City')->with('Country')->with('State')->with('Account')->get()->first();
        }

        return $setting;
    }

    public static function getstudentbirthday()
    {
        $today = Carbon::now()->format('m-d');
        $getstudentbirthday = DB::table('admissions')->where(DB::raw("DATE_FORMAT(dob, '%m-%d')"), $today)
            ->orderBy('id', 'DESC')->groupBy('admissionNo')
            ->whereNull('deleted_at')
            ->get();
        return $getstudentbirthday;
    }

    public static function getUsersBirthday()
    {
        $getUsersBirthday = User::whereRaw("DATE_FORMAT(dob, '%m-%d') = ?", [date('m-d')])
            ->orderBy('id', 'DESC')
            ->get();

        return $getUsersBirthday;
    }

    public static function getUser()
    {
        $role = Session::get('role_id');
        $user_id = Session::get('id');
        $teacher_id = Session::get('teacher_id');
        $student_id = Session::get('id');

        if ($role == 3) {
            $studentData = Admission::with('ClassTypes')->where('id', $student_id)->where('branch_id', Session::get('branch_id'))->get()->first();
            return $studentData;
        } else {
            $userData = User::where('id', $user_id)->get()->first();
            return $userData;
        }
    }

    public static function getSession()
    {
        $session = Sessions::all();
        return $session;
    }

    public static function getAllBranch()
    {
        $data = Branch::orderBy('id', 'ASC')->get();
        return $data;
    }

    public static function getSiderbar()
    {
        $getSidebar = Sidebar::orderBy('id', 'ASC')->get();
        return $getSidebar;
    }

    public static function getCount($model)
    {
        try {
            $modelClass = 'App\\Models\\' . $model;

            if (!class_exists($modelClass)) {
                return 0;
            }

            return $modelClass::count();
        } catch (\Exception $e) {
            // Log the error if needed
            return 0;
        }
    }

    // export data
    
    // public static function export($data, $type = 'excel', $fileName = 'export', $excelHeadings = [], $pdfView = '', $pdfDataKey = '')
    // {
    //     if ($type === 'excel') {
    //         $export = new class($data, $excelHeadings) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings {
    //             protected $data;
    //             protected $headings;

    //             public function __construct($data, $headings)
    //             {
    //                 $this->data = $data;
    //                 $this->headings = $headings;
    //             }

    //             public function collection()
    //             {
    //                 return $this->data;
    //             }

    //             public function headings(): array
    //             {
    //                 return $this->headings;
    //             }
    //         };

    //         return Excel::download($export, $fileName . '.xlsx');
    //     }

    //     if ($type === 'pdf') {
    //         $pdf = Pdf::loadView($pdfView, [$pdfDataKey => $data]);
    //         return $pdf->download($fileName . '.pdf');
    //     }

    //     return response()->json(['error' => 'Invalid export type'], 400);
    // }

    public static function getName($model, $id)
    {
        try {
            $modelClass = 'App\\Models\\' . $model;

            if (!class_exists($modelClass)) {
                return [];
            }

            return $modelClass::find($id);
        } catch (\Exception $e) {
            // Log the error if needed
            return [];
        }
    }

    public static function countByColumnValue($model, $column, $id)
    {

        try {
            $modelClass = 'App\\Models\\' . $model;

            if (!class_exists($modelClass)) {
                return 0;
            }

            return $modelClass::where($column, $id)->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    public static function getAllData($model)
    {
        try {
            $modelClass = 'App\\Models\\' . $model;

            if (!class_exists($modelClass)) {
                return [];
            }

            return $modelClass::get();
        } catch (\Exception $e) {
            // Log the error if needed
            return [];
        }
    }

    public static function countQuestionByLatestCreatedDate($model)
    {
        $latest = Question::orderBy('id', 'desc')->first();

        if ($latest) {
            // Step 2: Extract only the date from the latest created_at
            $latestDate = date('Y-m-d', strtotime($latest->created_at));

            // Step 3: Count records with the same date
            $count = Question::whereDate('created_at', $latestDate)->count();

            return $count;
        } else {
            return 0;
        }
    }

    public static function countByCondition($model, $conditions = [])
    {
        try {
            $modelClass = 'App\\Models\\' . $model;

            if (!class_exists($modelClass)) {
                return 0;
            }

            $query = $modelClass::query();

            // Apply where conditions
            foreach ($conditions as $column => $value) {
                if (is_array($value)) {
                    // for whereIn type
                    $query->whereIn($column, $value);
                } else {
                    $query->where($column, $value);
                }
            }

            return $query->count();
        } catch (\Exception $e) {
            //\Log::error("getCount error: " . $e->getMessage());
            return 0;
        }
    }


    public static function getSavedDocuments($modelName, $modalType, $userId)
    {
        try {
            if (!$modelName || !$modalType || !$userId) {
                return collect();
            }

            $fullModel = "App\\Models\\$modelName";

            if (!class_exists($fullModel)) {
                return collect();
            }


            return $fullModel::where('model_name', $modalType)
                ->where('user_id', $userId)
                ->get();
        } catch (\Exception $e) {

            return collect();
        }
    }


    public static function sessionFilter($query)
    {
        $currentSession = Session::get('current_session');
        if ($currentSession) {
            return $query->where('session_id', $currentSession);
        }
        return $query;
    }
    public static function getFiltersConfig()
    {
        return [
            'Student' => ['keyword', 'admission_id', 'class_type_id'],
            'Teacher' => ['keyword', 'gender_id', 'status', 'department_id'],
            'User' => ['keyword', 'status', 'role_id'],
            'Admin' => ['keyword', 'status'],
            // Add more modules and their filters here
        ];
    }

    public static function applyFilters($query, $filters, $modalType)
    {


        // $filtersConfig = self::getFiltersConfig();


        $filtercolumns = is_array($filters['filterable_columns'])
            ? $filters['filterable_columns']
            : explode(',', (string) $filters['filterable_columns']);

        // Optional: trim spaces from each column name
        $filtercolumns = array_map('trim', $filtercolumns);
        // Get array of filter keys
        $allowedFilters = $filtercolumns;


        // Get allowed filters for the given modal
        // $allowedFilters = $filtersConfig[$modalType] ?? [];

        foreach ($filters as $key => $value) {
            if (in_array($key, $allowedFilters) && $value !== null && $value !== '') {
                switch ($key) {
                    case 'keyword':
                        $query->where(function ($q) use ($value) {
                            $q->where('name', 'like', "%$value%")
                                ->orWhere('email', 'like', "%$value%")
                                ->orWhere('mobile', 'like', "%$value%");
                        });
                        break;

                    // Generic exact match filters
                    case 'admission_id':
                    case 'gender_id':
                    case 'class_type_id':
                    case 'status':
                    case 'department_id':
                    case 'role_id':
                        $query->where($key, $value);
                        break;

                    // Add any special filter handling here if needed

                    default:
                        // Ignore unknown filters
                        break;
                }
            }
        }

        return $query;
    }

    public static function getUsedUnusedQuestionCount()
    {
        try {
            $examQuestionIds = Exam::pluck('questions_id')
                ->filter()
                ->flatMap(function ($item) {
                    return explode(',', $item);
                })
                ->map('trim')
                ->unique()
                ->toArray();

            $total = Question::count();
            $used = count($examQuestionIds);
            $unused = $total - $used;

            return [
                'total' => $total,
                'used' => $used,
                'unused' => $unused
            ];
        } catch (\Exception $e) {
            //\Log::error('getUsedUnusedQuestionCount error: ' . $e->getMessage());
            return [
                'total' => 0,
                'used' => 0,
                'unused' => 0
            ];
        }
    }
}
