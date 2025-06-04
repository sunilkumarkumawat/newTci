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
        [
            'title' => 'Dashboard',
            'className' => 'dashboard',
            'status' => true,
            'icon' => 'fa fa-desktop',
            'route' => 'dashboard',
        ],
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
                    'icon' => 'fa fa-plus',
                ],
                [
                    'title' => 'View User',
                    'className' => 'user_management.view',
                    'status' => true,
                    'route' => 'userView',
                    'icon' => 'fa fa-eye',
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
                    'title' => 'Add New Student',
                    'className' => 'student_management.add',
                    'status' => true,
                    'route' => 'studentAdd',
                    'icon' => 'fa fa-plus',
                ],
                [
                    'title' => 'View Students',
                    'className' => 'student_management.view',
                    'status' => true,
                    'route' => 'studentView',
                    'icon' => 'fa fa-eye',
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
                    'className' => 'question_bank.dashboard',
                    'status' => true,
                    'route' => 'questionBankManagement',
                    'icon' => 'fa fa-cog',
                ],
                [
                    'title' => 'Subjects/ Streams',
                    'className' => 'question_bank.add',
                    'status' => true,
                    'route' => 'subjects',
                    'icon' => 'fa fa-cog',
                ],
                [
                    'title' => 'Topics/ Subtopics',
                    'className' => 'question_bank.add',
                    'status' => true,
                    'route' => 'add_topic',
                    'icon' => 'fa fa-cog',
                ],
                [
                    'title' => 'Add New Question',
                    'className' => 'question_bank.add',
                    'status' => true,
                    'route' => 'add/question',
                    'icon' => 'fa fa-cog',
                ],
                [
                    'title' => 'Question List',
                    'className' => 'question_bank.view',
                    'status' => true,
                    'route' => 'view/question',
                    'icon' => 'fa fa-cog',
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
                    'icon' => 'fa fa-cog',
                ],
                [
                    'title' => 'Exam List',
                    'className' => 'exam_paper_creator.list',
                    'status' => true,
                    'route' => 'view/exam',
                    'icon' => 'fa fa-cog',
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
                    'title' => 'Batch',
                    'className' => 'master_management.batch',
                    'status' => true,
                    'route' => 'addBatch',
                    'icon' => 'fa fa-cog',
                ],
                [
                    'title' => 'Class',
                    'className' => 'master_management.class',
                    'status' => true,
                    'route' => 'add_class',
                    'icon' => 'fa fa-cog',
                ],
                [
                    'title' => 'Role',
                    'className' => 'master_management.role',
                    'status' => true,
                    'route' => 'role_add',
                    'icon' => 'fa fa-cog',
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
                    'icon' => 'fa fa-cog',
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
    
    // Build fully qualified class name if not already
    if (!str_contains($modal, '\\')) {
        $modal = 'App\\Models\\' . $modal;
    }

    // Check if class exists
    if (!class_exists($modal)) {
        return [];
    }

    try {
        $query = $modal::query();

        // If a dependent ID is provided, apply where condition
        if ($dependentId !== null) {
            $query->where($foreignKey, $dependentId);
        }

        // Build id => name array (assumes 'id' and 'name' fields exist)
        return $query->pluck('name', 'id')->toArray();
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
}
