<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommonService;
use Auth;
use Illuminate\Support\Facades\Artisan;
use DB;
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
        return view('branch.add',compact('data'));
    }
    public function role()
    {
        $data = null;
        return view('role.add',compact('data'));
    }
    public function batches()
    {
        $data = null;
        return view('batches.add',compact('data'));
    }
   
    public function expense()
    {
        $data = null;
        return view('expense.add',compact('data'));
    }
    
    public function setting()
    {
        $data = null;
        return view('setting.add',compact('data'));
    }

    public function subject()
    {
        $data = null;
        return view('subject.add',compact('data'));
    }

    public function chapter()
    {
        $data = null;
        return view('chapter.add',compact('data'));
    }

    public function topics()
    {
        $data = null;
        return view('topic.add',compact('data'));
    }

    public function studentIdPassword()
    {
        $data = null;
        return view('student.studentIdPassword',compact('data'));
    }
    public function userPassword()
    {
        $data = null;
        return view('user.userPassword',compact('data'));
    }

     public function createCommon(Request $request)
    {
        return $this->commonService->createCommon($request);
    }
     public function changeStatusCommon(Request $request,$modal, $id)
    {
        return $this->commonService->changeStatusCommon($request,$modal, $id);
    }
     public function deleteCommon(Request $request,$modal, $id)
    {
        return $this->commonService->deleteCommon($request,$modal, $id);
    }
public function commonEdit(Request $request,$modal,$id)
    {
        
        $data =  $this->commonService->commonEdit($request,$modal,$id);

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



public function chaptersData (Request $request)
{
    $query = DB::table('chapters')
        ->leftJoin('subject', 'chapters.subject_id', '=', 'subject.id')
        ->select(
            'chapters.id',
            'chapters.name',
            'subject.name as subject_name'
        );

    return DataTables::of($query)
    ->addIndexColumn()
    ->filterColumn('subject_name', function($query, $keyword) {
        $query->whereRaw("LOWER(subject.name) like ?", ["%".strtolower($keyword)."%"]);
    })
    ->addColumn('action', function($row){
        return view('chapter.partials.actions', compact('row'))->render();
    })
    ->rawColumns(['action'])
    ->make(true);
}

public function topicData(Request $request)
{
    $query = DB::table('topics')
    ->leftJoin('subject', function($join) {
        $join->on('topics.subject_id', '=', 'subject.id')
             ->whereNull('subject.deleted_at');
    })
    ->leftJoin('chapters', function($join) {
        $join->on('topics.chapter_id', '=', 'chapters.id')
             ->whereNull('chapters.deleted_at');
    })
    ->leftJoin('class_types', function($join) {
        $join->on('topics.class_type_id', '=', 'class_types.id')
             ->whereNull('class_types.deleted_at');
    })
    ->select(
        'topics.id',
        'topics.name',
        'subject.name as subject_name',
        'chapters.name as chapter_name',
        'class_types.name as class_name'
    )
    ->whereNull('topics.deleted_at'); // Also exclude deleted topics


    return DataTables::of($query)
    ->addIndexColumn()
    ->addColumn('action', function($row){
        return view('topic.partials.actions', compact('row'))->render();
    })
    ->rawColumns(['action'])
    ->make(true);
}

public function allTypeUsersData(Request $request)
{
    $modalType = $request->input('modal_type');
   $columnsInput = $request->input('columns');

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
    $query = Helper::sessionFilter($query);

    $data = $query->get($columns);

    return response()->json(['status' => true, 'data' => $data]);
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
