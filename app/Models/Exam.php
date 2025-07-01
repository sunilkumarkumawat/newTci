<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Exam extends Model
{
        use SoftDeletes;
	protected $table = "exams"; //table name

     protected $guarded = [];
    
}