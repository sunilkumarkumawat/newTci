<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;
class AssignedSubjects extends Model
{
       use SoftDeletes;
	protected $table = "subject"; //table name
	

	
}