<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ExamResult extends Model
{
        use SoftDeletes;
	protected $table = "exam_results"; //table name
        protected $guarded = [];
}