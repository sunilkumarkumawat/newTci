<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
class Student extends Model
{
        use SoftDeletes;
//	protected $table = "olympiad_results"; //table name
protected $table = "admissions"; //table name
	protected $guarded = [];
	
	public function Student()
    {
        return $this->belongsTo('App\Models\Enquiry','student_id');
    }
    public function ClassTypes()
    {
        return $this->belongsTo('App\Models\ClassType','class_type_id');
    }
     public function PreviousClass()
    {
        return $this->belongsTo('App\Models\ClassType','previous_class_type_id');
    }
     public function PreviousCity()
    {
        return $this->belongsTo('App\Models\City','previous_city_id');
    }
     public function PreviousState()
    {
        return $this->belongsTo('App\Models\State','previous_state_id');
    }
     public function City()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }
    
    public function State()
    {
        return $this->belongsTo('App\Models\State','state_id');
    }

     public function Gender()
    {
        return $this->belongsTo('App\Models\Gender','gender_id');
    }
    
      
    
    public function FeesAssign()
    {
        return $this->belongsTo('App\Models\fees\FeesAssign','admissionNo');
    }
    
    public static function countActiveAdmission(){
        $data = Admission::where('session_id',Session::get('session_id'))->where('status',1)->where('school',1);
        if(Session::get('role_id') > 1){
            
            if(Session::get('role_id') == 2)
            {
                
                $classTeacherOf = DB::table('teachers')->where('id',Session::get('teacher_id'))->whereNull('deleted_at')->first('class_type_id');
                
                if(!empty($classTeacherOf))
                {
                    $data = $data->where('branch_id',Session::get('branch_id'))->where('class_type_id',$classTeacherOf->class_type_id);
                    
                }
               
            
        }
        else
        {
             $data = $data->where('branch_id',Session::get('branch_id'));
        }
        
        }
        
       
        
        
        if (!empty(Session::get('admin_branch_id'))) {
                   $data = $data->where('branch_id', Session::get('admin_branch_id'));
                }
        $student = $data->count();
            return $student;
    }
    
    public static function countAdmissionHostel(){
        $data = Admission::where('session_id',Session::get('session_id'))->where('status',1)->where('hostel',1);
        
        if(Session::get('role_id') > 1){
           $data = $data->where('branch_id',Session::get('branch_id'));
        }
            $data = $data->count();
        return $data;
    }
    
    public static function countAdmissionLibrary(){
        $data=Admission::where('session_id',Session::get('session_id'))->where('status',1)->where('library',1);
        
        if(Session::get('role_id') > 1){
            $data = $data->where('branch_id',Session::get('branch_id'));
        }
        
        $data = $data->count();
        return $data;
    }
    public static function countTodaysBirthday(){
        $today=now();
        $data=Admission::whereMonth('dob',$today->month)->whereDay('dob',$today->day)->where('library_id',Session::get('defaultLibrary'));
        
        if(Session::get('role_id') > 4){
            $data = $data->where('branch_id',Session::get('branch_id'));
        }
        
        $data = $data->count();
        return $data;
    }
    
    
    
}
