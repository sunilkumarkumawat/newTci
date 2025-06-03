<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TeacherAttendance extends Model
{
       use SoftDeletes;
	protected $table = "teacher_attendance"; //table name
	
	public function Teacher()
    {
        return $this->belongsTo('App\Models\Teacher','teacher_id');
    }
    	public function AttendanceStatus()
    {
        return $this->belongsTo('App\Models\AttendanceStatus','attendance_status_id');
    }
	 public static function countTeacherAttendance(){
        $data=TeacherAttendance::where('date',date('Y-m-d'))->where('attendance_status_id',1)->where('branch_id',Session::get('branch_id'));
	 if(Session::get('role_id') == 1){
            $data = $data->count();
        }else{
            $data = $data->where('class_type_id',Session::get('class_type_id'))->count();
        }
            return $data;
            
        return 0;
    }
	
}
