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
use DB;
use Session;
use Illuminate\Support\Facades\Auth;
class Helper
{

 public static function getPermissions()
{
    $user = Auth::user();
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
            'title' => 'Exam Paper Creator',
            'className' => 'exam_paper_creator',
            'status' => true,
            'icon' => 'fa fa-calendar-check',
            'subItems' => [
                [
                    'title' => 'Create New Exam',
                    'className' => 'exam_paper_creator.add',
                    'status' => true,
                    'route' => 'addExamNeet',
                    'icon' => 'fa fa-circle',
                ],
                [
                    'title' => 'Exam List',
                    'className' => 'exam_paper_creator.list',
                    'status' => true,
                    'route' => 'view/exam',
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
    ];

    // Filter based on permissions for non-admin users
    if (Auth::user()->role_id != 1) {
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

       
        if($baseModalName == 'AssignedSubjects')
    {
       
     $query = $modal::leftJoin('all_subjects', 'subject.subject_id', '=', 'all_subjects.id')
    ->where('subject.' . $foreignKey, $dependentId);
    
      // Build id => name array (assumes 'id' and 'name' fields exist)
        return $query->pluck('all_subjects.name', 'all_subjects.id')->toArray();
    }
    else{
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

    public static function getSetting(){
       
        $setting = Setting::where('branch_id',Session::get('branch_id'))->with('Account')->with('City')->with('Country')->with('State')->with('Account')->get()->first();
        
          if(empty($setting)){
             $setting = Setting::where('branch_id',1)->with('Account')->with('City')->with('Country')->with('State')->with('Account')->get()->first();
          }
       
        return $setting;
    
     } 

     public static function getstudentbirthday(){
        $today = Carbon::now()->format('m-d'); 
    $getstudentbirthday = DB::table('admissions')->where(DB::raw("DATE_FORMAT(dob, '%m-%d')"), $today)
        ->orderBy('id', 'DESC')->groupBy('admissionNo')
         ->whereNull('deleted_at')
        ->get();
       return $getstudentbirthday;
   }  

   public static function getUsersBirthday(){
    $getUsersBirthday = User::whereRaw("DATE_FORMAT(dob, '%m-%d') = ?", [date('m-d')])
        ->orderBy('id', 'DESC')
        ->get();
        
       return $getUsersBirthday;
   }  

   public static function getUser(){
    $role=Session::get('role_id');
    $user_id=Session::get('id');
    $teacher_id=Session::get('teacher_id');
    $student_id=Session::get('id');
  
      if($role==3){
         $studentData = Admission::with('ClassTypes')->where('id',$student_id)->where('branch_id',Session::get('branch_id'))->get()->first();
      return $studentData;
      }else{
         $userData = User::where('id',$user_id)->get()->first(); 
      return $userData;
      }
        
  }

  public static function getSession(){
    $session = Sessions::all();
    return $session;
}

public static function getAllBranch(){
    $data = Branch::orderBy('id','ASC')->get();
    return $data;
}

public static function getSiderbar(){
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

public static function getThisCount($model, $column, $id)
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

}
