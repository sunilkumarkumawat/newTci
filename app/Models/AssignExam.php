<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AssignExam extends Model
{
        use SoftDeletes;
	protected $table = "assign_exams"; //table name
	
        protected $guarded = [];
}