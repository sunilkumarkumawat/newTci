<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Invoice extends Model
{
        use SoftDeletes;
	protected $table = "invoices"; //table name
	
	 public static function totalPendings(){
        $data = Invoice::where('session_id',Session::get('session_id'))->where('due_amount','>',0)->where('library_id',Session::get('defaultLibrary'))->count();
      $data = Invoice::where('session_id', Session::get('session_id'))->where('library_id',Session::get('defaultLibrary'))
    ->where(function($query) {
        $query->where('due_amount','>',0)
              ->orWhereNull('due_amount');
    })
    ->count();
      
        return $data;
    }
    
     public static function totalPaid(){
        $data = Invoice::where('session_id',Session::get('session_id'))->where('due_amount','=',0)->where('library_id',Session::get('defaultLibrary'))->count();
        return $data;
    }
     public static function totalDue(){
        $data = Invoice::where('session_id',Session::get('session_id'))->where('due_amount','>',0)->where('library_id',Session::get('defaultLibrary'))->where('waiver_status',0)->sum('due_amount');
        return $data;
    }
    
}