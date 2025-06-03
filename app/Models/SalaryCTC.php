<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SalaryCTC extends Model
{
        use SoftDeletes;
	protected $table = "salary_ctc"; //table name
	

	
}