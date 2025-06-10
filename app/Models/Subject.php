<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;
class Subject extends Model
{
       use SoftDeletes;
	protected $table = "all_subjects"; //table name
	
    protected $guarded = [];
    
     
	
}