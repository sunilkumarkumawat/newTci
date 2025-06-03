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


    public static function getSidebar(){
$sidebarMenu = [
    [
        'title' => 'Dashboard',
        'status' => true,
        'icon' => 'fa fa-desktop',
         'route'  => 'dashboard',
    ],
    [
        'title' => 'User Management',
        'status' => true,
        'icon' => 'fa fa-users',
        'subItems' => [
            [
                'title' => 'Add User',
                'status' => true,
                'route'  => 'userAdd',
                'icon'   => 'fa fa-plus',
            ],
            [
                'title' => 'View User',
                'status' => true,
                'route'  => 'userView',
                'icon'   => 'fa fa-eye',
            ],
            // [
            //     'title' => 'View User',
            //     'status' => true,
            //     'route'  => 'userView',
            //     'icon'   => 'fa fa-eye',
            //     // Example of a sub-sub-menu:
            //     'subItems' => [
            //         [
            //             'title' => 'View Active Users',
            //             'status' => true,
            //             'route'  => 'viewActiveUser',
            //             'icon'   => 'fa fa-user-check',
            //         ],
            //         [
            //             'title' => 'View Inactive Users',
            //             'status' => true,
            //             'route'  => 'viewInactiveUser',
            //             'icon'   => 'fa fa-user-times',
            //         ],
            //     ],
            // ],
        ],
    ],
    [
        'title' => 'Student Management',
        'status' => true,
        'icon' => 'fa fa-person',
        'subItems' => [
            [
                'title' => 'Add New Student',
                'status' => true,
                'route'  => 'studentAdd',
                'icon'   => 'fa fa-plus',
            ],
            [
                'title' => 'View Students',
                'status' => true,
                'route'  => 'studentView',
                'icon'   => 'fa fa-eye',
            ],
        ],
    ],
    [
        'title' => 'Question Bank',
        'status' => true,
        'icon' => 'fa fa-check-square',
        'subItems' => [
            [
                'title' => 'Dashboard',
                'status' => true,
                'route'  => 'questionBankManagement',
                'icon'   => 'fa fa-cog',
            ],
            [
                'title' => 'Subjects/ Streams',
                'status' => true,
                'route'  => 'subjects',
                'icon'   => 'fa fa-cog',
            ],
            [
                'title' => 'Topics/ Subtopics',
                'status' => true,
                'route'  => 'add_topic',
                'icon'   => 'fa fa-cog',
            ],
            [
                'title' => 'Add New Question',
                'status' => true,
                'route'  => 'add/question',
                'icon'   => 'fa fa-cog',
            ],
            [
                'title' => 'Question List',
                'status' => true,
                'route'  => 'view/question',
                'icon'   => 'fa fa-cog',
            ],
        ],
    ],
    [
        'title' => 'Exam Paper Creator',
        'status' => true,
        'icon' => 'fa fa-calendar-check',
        'subItems' => [
            [
                'title' => 'Create New Exam',
                'status' => true,
                'route'  => 'addExamNeet',
                'icon'   => 'fa fa-cog',
            ],
            [
                'title' => 'Exam List',
                'status' => true,
                'route'  => 'view/exam',
                'icon'   => 'fa fa-cog',
            ],
        ],
    ],
    [
        'title' => 'Master Management',
        'status' => true,
        'icon' => 'fa fa-sitemap',
        'subItems' => [
            [
                'title' => 'Batch',
                'status' => true,
                'route'  => 'addBatch',
                'icon'   => 'fa fa-cog',
            ],
            [
                'title' => 'Class',
                'status' => true,
                'route'  => 'add_class',
                'icon'   => 'fa fa-cog',
            ],
            [
                'title' => 'Role',
                'status' => true,
                'route'  => 'role_add',
                'icon'   => 'fa fa-cog',
            ],
        ],
    ],
    [
        'title' => 'Institute Management',
        'status' => true,
        'icon' => 'fa fa-cog',
        'subItems' => [
            [
                'title' => 'View Setting',
                'status' => true,
                'route'  => 'setting',
                'icon'   => 'fa fa-cog',
            ],
        ],
    ],
];


  return $sidebarMenu;
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
