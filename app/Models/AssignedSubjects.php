<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;
class AssignedSubjects extends Model
{
       use SoftDeletes;
	protected $table = "subject"; //table name
	

	
}