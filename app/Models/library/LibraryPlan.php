<?php

namespace App\Models\library;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LibraryPlan extends Model
{
        use SoftDeletes;
	protected $table = "library_plans"; //table name
	
	
	public static function countData(){
        $data = LibraryPlan::groupBy('admission_id')->where('library_id',Session::get('defaultLibrary'))->get()->count(); 
		           return $data;
	}
	public static function overdue14(){
       $startDate = date('Y-m-d', strtotime('-14 days'));
$dataCount = LibraryPlan::where('library_id',Session::get('defaultLibrary'))->where('renew_date', '<=',$startDate)->count();
		           return $dataCount;
	}
	
	public static function recentoverdue14(){
       $startDate = date('Y-m-d', strtotime('-14 days'));
$endDate = date('Y-m-d', strtotime('-1 days'));

$dataCount = LibraryPlan::where('library_id',Session::get('defaultLibrary'))->where('renew_date', '>',$startDate)->where('renew_date', '<=',$endDate)->count();
		           return $dataCount;
	}
	public static function duedate3(){
       $startDate = date('Y-m-d');
$endDate = date('Y-m-d', strtotime('+3 days'));

$dataCount = LibraryPlan::where('library_id',Session::get('defaultLibrary'))->where('renew_date', '>',$startDate)->where('renew_date', '<=',$endDate)->count();
		           return $dataCount;
	}
	public static function due_today(){
       $startDate = date('Y-m-d');


$dataCount = LibraryPlan::where('library_id',Session::get('defaultLibrary'))->where('renew_date', '=',$startDate)->count();
		           return $dataCount;
	}
	public static function newEnrollmentLibrary(){
       $startDate = date('Y-m-d');


$dataCount = LibraryPlan::where('library_id',Session::get('defaultLibrary'))->whereDate('created_at',$startDate)->count();
		           return $dataCount;
	}
	public static function yesterdayEnrollmentLibrary(){
       $startDate = date('Y-m-d', strtotime('-1 days'));


$dataCount = LibraryPlan::where('library_id',Session::get('defaultLibrary'))->whereDate('created_at',$startDate)->count();
		           return $dataCount;
	}
	public static function monthEnrollmentLibrary(){
       $startDate = date('m');


$dataCount = LibraryPlan::where('library_id',Session::get('defaultLibrary'))->whereMonth('created_at',$startDate)->count();
		           return $dataCount;
	}

}