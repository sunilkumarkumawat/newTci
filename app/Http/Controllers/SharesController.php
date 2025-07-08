<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Subject;
use Session;
use Yajra\DataTables\Facades\DataTables;
use Helper;

class SharesController extends Controller
{
    protected $commonService;

    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }

    // List branches
    public function commonView(Request $request)
    {
        $modal = $request->modal_type ?? '';
        $modalLower = strtolower($modal);



        if ($modalLower === 'batches') {
            // Example: filter by category and join with exam_patterns
            $query = DB::table('batches')
                ->leftJoin('exam_patterns', 'batches.category_id', '=', 'exam_patterns.id')
                ->leftJoin('sessions', 'batches.session_id', '=', 'sessions.id')
                ->select(
                    'batches.*',
                    'exam_patterns.name as exam_pattern_name',
                    'sessions.name as session_name'
                );

            // Optional: filter by category if provided
            if ($request->filled('category')) {
                $query->where('batches.category', $request->input('category'));
            }




            $data = $query->get();
        } else {
            $data = $this->commonService->getAll($modal);
        }

        return view($modalLower . '/view', compact('data'));
    }


    public function branch()
    {
        $data = null;
        return view('branch.add', compact('data'));
    }
    public function role()
    {
        $data = null;
        return view('role.add', compact('data'));
    }
    public function batches()
    {
        $data = null;
        return view('batches.add', compact('data'));
    }

    public function expense()
    {
        $data = null;
        return view('expense.add', compact('data'));
    }

    public function setting()
    {
        $data = null;
        return view('setting.add', compact('data'));
    }

    public function subject()
    {
        $data = null;
        return view('subject.add', compact('data'));
    }

    public function tags()
    {
        $data = null;
        return view('tags.add', compact('data'));
    }

    public function chapter()
    {
        $data = null;
        return view('chapter.add', compact('data'));
    }

    public function topics()
    {
        $data = null;
        return view('topic.add', compact('data'));
    }

    public function studentIdPassword()
    {
        $data = null;
        return view('student.studentIdPassword', compact('data'));
    }

    public function studentTestHistory()
    {
        $data = null;
        return view('student.studentTestHistory', compact('data'));
    }

    public function performanceReport()
    {
        $data = null;
        return view('student.performanceReport', compact('data'));
    }

    public function studentFeesStatus()
    {
        $data = null;
        return view('student.studentFeesStatus', compact('data'));
    }

    public function userPassword()
    {
        $data = null;
        return view('user.userPassword', compact('data'));
    }

    public function questions()
    {
        $data = null;
        return view('questions.add', compact('data'));
    }

    public function questionDashboard()
    {
        $data = null;
        return view('questions.dashboard', compact('data'));
    }

    public function questionView()
    {
        $data = null;
        return view('questions.questionView', compact('data'));
    }
    public function recycleBin()
    {
        $data = null;
        return view('questions.recycleBin', compact('data'));
    }

    public function createCommon(Request $request)
    {
        return $this->commonService->createCommon($request);
    }
    public function changeStatusCommon(Request $request, $modal, $id)
    {
        return $this->commonService->changeStatusCommon($request, $modal, $id);
    }
    public function deleteCommon(Request $request, $modal, $id)
    {
        return $this->commonService->deleteCommon($request, $modal, $id);
    }

    public function deleteForceCommon(Request $request, $modal, $id)
    {
        return $this->commonService->deleteForceCommon($request, $modal, $id);
    }

    public function restoreCommon(Request $request, $modal, $id)
    {
        return $this->commonService->restoreCommon($request, $modal, $id);
    }

    public function commonEdit(Request $request, $modal, $id)
    {

        $data =  $this->commonService->commonEdit($request, $modal, $id);

        $responseData = $data->getData();

        $data = isset($responseData->data) && !empty($responseData->data)
            ? $responseData->data
            : [];

        return view(strtolower($modal) . '/add', compact('data'));
    }
    public function getDependentOptions(Request $request)
    {
        $data =  $this->commonService->getDependentOptions($request);


        return response()->json($data);
    }
    public function setPermissionView(Request $request, $roleId, $userId = null)
    {
        $finalPermissions = [];

        if (!empty($userId)) {
            // Check for user-specific permissions
            $userPermissions = DB::table('user_permissions')
                ->where('user_id', $userId)
                ->pluck('permission')
                ->toArray();

            if (!empty($userPermissions)) {
                $finalPermissions = $userPermissions;
            } else {
                // Fallback to role permissions if user has no specific permissions
                $finalPermissions = DB::table('role_permissions')
                    ->where('role_id', $roleId)
                    ->pluck('permission')
                    ->toArray();
            }
        } else {
            // Only role permissions when no userId is provided
            $finalPermissions = DB::table('role_permissions')
                ->where('role_id', $roleId)
                ->pluck('permission')
                ->toArray();
        }

        // Pass to view
        $permissions = [
            'role_id' => $roleId,
            'user_id' => $userId,
            'permissions' => $finalPermissions,
        ];

        return view('role.permission', compact('permissions'));
    }

    public function savePermission(Request $request)
    {
        $roleId = $request->role_id;
        $permissions = $request->permissions ?? []; // array of permissions

        // Clear existing permissions for the role
        DB::table('role_permissions')->where('role_id', $roleId)->delete();

        // Prepare insert data
        $insertData = [];
        foreach ($permissions as $permission) {
            $insertData[] = [
                'role_id' => $roleId,
                'permission' => $permission,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert new permissions
        if (!empty($insertData)) {
            DB::table('role_permissions')->insert($insertData);
        }

        return response()->json(['success' => true, 'message' => 'Permissions saved successfully.']);
    }
    public function setCurrentBranch(Request $request)
    {
        $branchId = $request->input('currentSelectedBranch');

        if ($branchId) {
            // Set session
            session(['currentSelectedBranch' => $branchId]);

            // Find and update user
            $user = \App\Models\User::find(Auth::id());

            if ($user) {
                $user->selectedBranchId = $branchId;
                $user->save();

                // Re-login user with updated info
                Auth::login($user);

                Artisan::call('cache:clear');
                Artisan::call('config:clear');
                Artisan::call('route:clear');
                Artisan::call('view:clear');

                return response()->json(['status' => 'success']);
            }

            return response()->json(['status' => 'error', 'message' => 'User not found']);
        }

        return response()->json(['status' => 'error', 'message' => 'No branch selected']);
    }



    public function chaptersData(Request $request)
    {
        $query = DB::table('chapters')
            ->leftJoin('all_subjects', 'chapters.subject_id', '=', 'all_subjects.id')
            ->select(
                'chapters.id',
                'chapters.name',
                'all_subjects.name as subject_name'
            )
            ->whereNull('chapters.deleted_at');;

        return DataTables::of($query)
            ->addIndexColumn()
            ->filterColumn('subject_name', function ($query, $keyword) {
                $query->whereRaw("LOWER(subject.name) like ?", ["%" . strtolower($keyword) . "%"]);
            })
            ->addColumn('action', function ($row) {
                return view('chapter.partials.actions', compact('row'))->render();
            })
            ->editColumn('name', function ($row) {
                $quesCount = Helper::countByColumnValue('Question', 'chapter_id', $row->id) ?? '0';
                $label = $row->name;
                if ($quesCount > 0) {
                    $label .= ' <small class="text-primary">Ques.: ' . $quesCount . '</small>';
                }
                return $label;
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
    }

    public function topicData(Request $request)
    {
        $query = DB::table('topics')
            ->leftJoin('all_subjects', function ($join) {
                $join->on('topics.subject_id', '=', 'all_subjects.id')
                    ->whereNull('all_subjects.deleted_at');
            })
            ->leftJoin('chapters', function ($join) {
                $join->on('topics.chapter_id', '=', 'chapters.id')
                    ->whereNull('chapters.deleted_at');
            })
            ->leftJoin('class_types', function ($join) {
                $join->on('topics.class_type_id', '=', 'class_types.id')
                    ->whereNull('class_types.deleted_at');
            })
            ->select(
                'topics.id',
                'topics.name',
                'all_subjects.name as subject_name',
                'chapters.name as chapter_name',
                'class_types.name as class_name'
            )
            ->whereNull('topics.deleted_at'); // Also exclude deleted topics


        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('topic.partials.actions', compact('row'))->render();
            })
            ->editColumn('name', function ($row) {
                $quesCount = Helper::countByColumnValue('Question', 'topic_id', $row->id) ?? '0';
                $label = $row->name;
                if ($quesCount > 0) {
                    $label .= ' <small class="text-primary">Ques.: ' . $quesCount . '</small>';
                }
                return $label;
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
    }

    // data already exist or not
    // public function checkUserExist(Request $request)
    // {
    //     $field = $request->field;
    //     $value = $request->value;
    //     $exceptId = $request->except_id;

    //     if (!in_array($field, ['email', 'mobile']) || !$value) {
    //         return response()->json(['exists' => false]);
    //     }

    //     $query = \App\Models\User::where($field, $value);
    //     if ($exceptId) {
    //         $query->where('id', '!=', $exceptId);
    //     }

    //     $exists = $query->exists();

    //     return response()->json([
    //         'exists' => $exists,
    //         'message' => $exists ? ucfirst($field) . ' already exists.' : ''
    //     ]);
    // }

    // get Student data
    public function studentData(Request $request)
    {
        $filters = $request->filterable_columns ?? [];

        $query = Student::query()
            ->leftJoin('gender', function ($join) {
                $join->on('student.gender', '=', 'gender.id')
                    ->whereNull('gender.deleted_at');
            })
            ->leftJoin('class_types', function ($join) {
                $join->on('student.class_type_id', '=', 'class_types.id')
                    ->whereNull('class_types.deleted_at');
            })
            ->select(
                'student.id',
                'student.admissionNo',
                'student.name',
                // 'student.class_type_id',
                'student.email',
                'student.mobile',
                'student.image',
                'student.gender',
                'student.dob',
                'student.status',
                'class_types.name as class'
            );

        // Apply filters
        foreach ($filters as $filter) {
            $name = $filter['name'] ?? null;
            $value = $filter['value'] ?? null;

            if ($name && $value !== null && $value !== '') {
                if ($name === 'keyword') {
                    $query->where(function ($q) use ($value) {
                        $q->where('student.name', 'like', "%{$value}%")
                            ->orWhere('student.email', 'like', "%{$value}%")
                            ->orWhere('student.mobile', 'like', "%{$value}%")
                            ->orWhere('student.admissionNo', 'like', "%{$value}%");
                    });
                } else {
                    $query->where("student.$name", $value);
                }
            }
        }

        return DataTables::of($query)
            ->addIndexColumn()


            // Profile Image
            ->editColumn('image', function ($item) {
                $imageUrl = $item->image
                    ? asset($item->image)
                    : asset('defaultImages/imageError.png');
                return '<img src="' . $imageUrl . '" width="40" height="40" class="rounded-circle profileImg" style="cursor:pointer;" />';
            })

            // Status Badge
            ->editColumn('status', function ($item) {
                $badge = $item->status
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';
                return '<span style="cursor:pointer;" data-id="' . $item->id . '" data-status="' . $item->status . '" class="change-status-btn">' . $badge . '</span>';
            })

            // Gender Formatting
            ->editColumn('gender', function ($item) {
                switch ($item->gender) {
                    case 1:
                        return 'Male';
                    case 2:
                        return 'Female';
                    case 3:
                        return 'Other';
                    default:
                        return '-';
                }
            })

            // Format DOB
            ->editColumn('dob', function ($item) {
                return $item->dob ? \Carbon\Carbon::parse($item->dob)->format('d-m-Y') : '';
            })

            // Action Buttons
            ->addColumn('action', function ($row) {
                return view('student.partials.actions', compact('row'))->render();
            })

            ->rawColumns(['image', 'status', 'action'])
            ->make(true);
    }


    // get user data
    public function userData(Request $request)
    {
        $filters = $request->filterable_columns ?? [];

        $query = User::query()
            ->leftJoin('role', function ($join) {
                $join->on('users.role_id', '=', 'role.id')
                    ->whereNull('role.deleted_at');
            })
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.mobile',
                'users.image',
                'users.gender',
                'users.dob',
                'users.status',
                'users.role_id',
                'role.name as role_name'
            );

        // Apply filters
        foreach ($filters as $filter) {
            $name = $filter['name'] ?? null;
            $value = $filter['value'] ?? null;

            if ($name && $value !== null && $value !== '') {
                if ($name === 'keyword') {
                    $query->where(function ($q) use ($value) {
                        $q->where('users.name', 'like', "%{$value}%")
                            ->orWhere('users.email', 'like', "%{$value}%")
                            ->orWhere('users.mobile', 'like', "%{$value}%");
                    });
                } else {
                    $query->where("users.$name", $value);
                }
            }
        }

        return DataTables::of($query)
            ->addIndexColumn()

            // User profile image
            ->editColumn('image', function ($item) {
                $imageUrl = $item->image
                    ? asset($item->image)
                    : asset('defaultImages/imageError.png');
                return '<img src="' . $imageUrl . '" width="40" height="40" class="rounded-circle profileImg" style="cursor:pointer;" />';
            })

            // Status Badge
            ->editColumn('status', function ($item) {
                $badge = $item->status
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';
                return '<span style="cursor:pointer;" data-id="' . $item->id . '" data-status="' . $item->status . '" class="change-status-btn">' . $badge . '</span>';
            })
            // Gender formatting
            ->editColumn('gender', function ($item) {
                switch ($item->gender) {
                    case 1:
                        return 'Male';
                    case 2:
                        return 'Female';
                    case 3:
                        return 'Other';
                    default:
                        return '-';
                }
            })

            // Format DOB
            ->editColumn('dob', function ($item) {
                return $item->dob ? \Carbon\Carbon::parse($item->dob)->format('d-m-Y') : '';
            })

            // Action buttons partial
            ->addColumn('action', function ($row) {
                return view('user.partials.actions', compact('row'))->render();
            })

            ->rawColumns(['gender', 'image', 'status', 'action'])
            ->make(true);
    }


    public function questionData(Request $request)
    {

        $filters = $request->filterable_columns ?? [];

        $query = DB::table('questions')
            ->leftJoin('all_subjects', function ($join) {
                $join->on('questions.subject_id', '=', 'all_subjects.id')
                    ->whereNull('all_subjects.deleted_at');
            })
            ->leftJoin('chapters', function ($join) {
                $join->on('questions.chapter_id', '=', 'chapters.id')
                    ->whereNull('chapters.deleted_at');
            })
            ->leftJoin('class_types', function ($join) {
                $join->on('questions.class_type_id', '=', 'class_types.id')
                    ->whereNull('class_types.deleted_at');
            })
            ->leftJoin('question_types', function ($join) {
                $join->on('questions.question_type_id', '=', 'question_types.id')
                    ->whereNull('question_types.deleted_at');
            })
            ->select(
                'questions.id',
                'questions.name',
                'questions.hi_name',
                'questions.ans_a',
                'questions.ans_b',
                'questions.ans_c',
                'questions.ans_d',
                'questions.deleted_at',
                'questions.correct_ans',
                'all_subjects.name as subject_name',
                'chapters.name as chapter_name',
                'class_types.name as class_name',
                'question_types.name as question_type'
            );

        $showDeletedOnly = false;

        foreach ($filters as $filter) {
            $name = $filter['name'] ?? null;
            $value = $filter['value'] ?? null;

            // Only process if name and value are present and value is not empty
            if ($name && $value !== null && $value !== '') {
                if ($name === 'is_deleted') {
                    $showDeletedOnly = (bool)$value;
                } else {
                    $query->where("questions.$name", $value);
                }
            }
        }

        // Apply deletion filter based on is_deleted flag
        if ($showDeletedOnly) {
            $query->whereNotNull('questions.deleted_at');
        } else {
            $query->whereNull('questions.deleted_at');
        }

        return DataTables::of($query)
            ->addIndexColumn()

            ->editColumn('name', function ($item) {
                return ($item->name ?? '') . '<br>' . ($item->hi_name ?? '');
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('questions.name', 'like', "%{$keyword}%")
                        ->orWhere('questions.hi_name', 'like', "%{$keyword}%");
                });
            })
            ->editColumn('correct_ans', function ($item) {
                switch ($item->correct_ans) {
                    case 1:
                        return $item->ans_a ?? '';
                    case 2:
                        return $item->ans_b ?? '';
                    case 3:
                        return $item->ans_c ?? '';
                    case 4:
                        return $item->ans_d ?? '';
                    default:
                        return '';
                }
            })
            ->addColumn('action', function ($row) {
                return view('questions.partials.actions', compact('row'))->render();
            })
            ->rawColumns(['name', 'ans_a', 'ans_b', 'ans_c', 'ans_d', 'correct_ans', 'action'])
            ->make(true);
    }

    // subject data
    public function subjectData(Request $request)
    {
        $filters = $request->filterable_columns ?? [];

        $query = Subject::query()->select('id', 'name');

        // Apply filters
        foreach ($filters as $filter) {
            $name = $filter['name'] ?? null;
            $value = $filter['value'] ?? null;

            if ($name && $value !== null && $value !== '') {
                if ($name === 'keyword') {
                    $query->where('name', 'like', "%{$value}%");
                } else {
                    $query->where($name, $value);
                }
            }
        }

        return DataTables::of($query)
            ->addIndexColumn()

            // Add Action column with buttons (partial or inline)
            ->addColumn('action', function ($row) {
                return view('subject.partials.actions', compact('row'))->render();
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    // tagsdata
    public function tagsData(Request $request)
    {
        $filters = $request->filterable_columns ?? [];

        $query = Tags::query()->select('id', 'name');

        // Apply filters
        foreach ($filters as $filter) {
            $name = $filter['name'] ?? null;
            $value = $filter['value'] ?? null;

            if ($name && $value !== null && $value !== '') {
                if ($name === 'keyword') {
                    $query->where('name', 'like', "%{$value}%");
                } else {
                    $query->where($name, $value);
                }
            }
        }

        return DataTables::of($query)
            ->addIndexColumn()

            // Add Action column with buttons (partial or inline)
            ->addColumn('action', function ($row) {
                return view('tags.partials.actions', compact('row'))->render();
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function allTypeUsersData(Request $request)
    {
        $modalType = $request->input('modal_type');
        $columnsInput = $request->input('gettable_columns');




        // Convert to array safely
        $columns = is_array($columnsInput)
            ? $columnsInput
            : explode(',', (string) $columnsInput);

        // Optional: trim spaces from each column name
        $columns = array_map('trim', $columns);

        if (!$modalType) {
            return response()->json(['status' => false, 'message' => 'Modal type is required.'], 400);
        }

        $modelClass = "App\\Models\\" . ucfirst($modalType);
        if (!class_exists($modelClass)) {
            return response()->json(['status' => false, 'message' => "Model $modalType not found."], 404);
        }

        $query = $modelClass::query();




        // Get all filters from request except modal_type
        $filters = $request->except('modal_type');

        // Apply filters dynamically
        $query = Helper::applyFilters($query, $filters, $modalType);

        if ($modalType == 'Student') {
            $query = Helper::sessionFilter($query);
        }
        $data = $query->get($columns);

        return response()->json(['status' => true, 'data' => $data]);
    }




    public function saveExcelData(Request $request, $modal)
    {
        $data = $request->input('data');

        // Validate modal type
        if (empty($modal)) {
            return response()->json([
                'status' => false,
                'message' => 'Modal type is required.'
            ], 400);
        }

        // Build and validate the model class
        $modelClass = "App\\Models\\" . ucfirst($modal);
        if (!class_exists($modelClass)) {
            return response()->json([
                'status' => false,
                'message' => "Model '$modal' not found."
            ], 404);
        }


        $role_id = $modal == 'Student' ? 3 : '';
        try {
    DB::beginTransaction();

    $timestamp = now();
    $insertedIds = [];

    foreach ($data as &$row) {
        $row['created_at'] = $timestamp;
        $row['updated_at'] = $timestamp;

        $record = $modelClass::create($row); // create() returns the inserted model
        $insertedIds[] = $record->id;
    }

    DB::commit();

    return response()->json([
        'success'       => true,
        'redirect_to'   => 'userView',
        'inserted_ids'  => implode(',', $insertedIds),
    ]);
} catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage();

            // Clean message if it's a column not found error
            if ($e instanceof \Illuminate\Database\QueryException && str_contains($errorMessage, 'Unknown column')) {
                preg_match("/Unknown column '([^']+)'/", $errorMessage, $matches);
                $column = $matches[1] ?? 'Unknown';
                $friendlyMessage = "Column \"$column\" not found in database table.";
            } else {
                $friendlyMessage = 'Failed to save data.';
            }

            return response()->json([
                'status' => false,
                'message' => $friendlyMessage,
            ], 500);
        }
    }
    public function generatePassword(Request $request)
    {
        $data = $request->all(); // includes modal_type, username[], password[]

        // Example: iterate over inputs
        $usernames = $data['userName'] ?? [];
        $passwords = $data['password'] ?? [];

        foreach ($usernames as $index => $username) {
            $password = $passwords[$index] ?? null;

            // Save to your modal, e.g., Student, Teacher, etc.
            // You may dynamically resolve the modal like:
            $modelClass = "App\\Models\\" . $request->modal_type;
            if (class_exists($modelClass)) {
                $modelInstance = $modelClass::find($data['id'][$index] ?? 0); // You may need to pass IDs too



                if ($modelInstance) {
                    $modelInstance->userName = $username;
                    $modelInstance->password = bcrypt($password); // or store plain if needed
                    $modelInstance->confirm_password = $password; // or store plain if needed
                    $modelInstance->save();
                }
            }
        }

        return response()->json(['status' => 'success']);
    }

   
}
