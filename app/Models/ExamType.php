<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ExamType extends Model
{
        use SoftDeletes;
	protected $table = "exam_types"; //table name
	
}