<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InvoiceDetail extends Model
{
    use SoftDeletes;
	protected $table = "invoice_details"; //table name
	
	public static function todayCollection(){
        //$data = InvoiceDetail::where('session_id',Session::get('session_id'))->whereDate('created_at',date('Y-m-d'))->sum('paid_amount');
        $data = InvoiceDetail::select('invoice_details.*', 'invoices.library_id')
                    ->leftJoin('invoices', 'invoices.id', '=', 'invoice_details.invoice_id')
                    ->where('invoices.library_id', Session::get('defaultLibrary'))
                    ->where('invoice_details.session_id', Session::get('session_id'))
                    ->whereDate('invoice_details.created_at', date('Y-m-d'))
                    ->sum('invoice_details.paid_amount');

        return $data;
    }
    
	public static function yesterdayCollection(){
        //$data = InvoiceDetail::where('session_id',Session::get('session_id'))->whereDate('created_at',date('Y-m-d', strtotime('-1 days')))->sum('paid_amount');
        $data = InvoiceDetail::select('invoice_details.*', 'invoices.library_id')
                    ->leftJoin('invoices', 'invoices.id', '=', 'invoice_details.invoice_id')
                    ->where('invoices.library_id', Session::get('defaultLibrary'))
                    ->where('invoice_details.session_id', Session::get('session_id'))
                    ->whereDate('invoice_details.created_at',date('Y-m-d', strtotime('-1 days')))->sum('invoice_details.paid_amount');
        
        
        return $data;
    }
    
	public static function monthCollection(){
        //$data = InvoiceDetail::where('session_id',Session::get('session_id'))->whereMonth('created_at',date('m'))->sum('paid_amount');
        $data = InvoiceDetail::select('invoice_details.*', 'invoices.library_id')
                    ->leftJoin('invoices', 'invoices.id', '=', 'invoice_details.invoice_id')
                    ->where('invoices.library_id', Session::get('defaultLibrary'))
                    ->where('invoice_details.session_id', Session::get('session_id'))
                    ->whereMonth('invoice_details.created_at',date('m'))->sum('invoice_details.paid_amount');
                    
        return $data;
    }
    
	public static function totalCollection(){
        //$data = InvoiceDetail::where('session_id',Session::get('session_id'))->sum('paid_amount');
         $data = InvoiceDetail::select('invoice_details.*', 'invoices.library_id')
                    ->leftJoin('invoices', 'invoices.id', '=', 'invoice_details.invoice_id')
                    ->where('invoices.library_id', Session::get('defaultLibrary'))
                    ->where('invoice_details.session_id', Session::get('session_id'))
                    ->sum('invoice_details.paid_amount');
        return $data;
    }
    
}