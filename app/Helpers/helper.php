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
    public static function getBranches()
    {
        $getBranch = Branch::orderBy('id', 'DESC');
        $getBranch = $getBranch->get();
        return $getBranch;
    }
       public static function getModalData($modal)
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
            // Fetch all records from the model
            $data = $modal::all();

            // Build a simple id => name array
            // Assumes each model has 'id' and 'name' fields
            return $data->pluck('name', 'id')->toArray();
        } catch (\Exception $e) {
            // Log or handle error if needed
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
