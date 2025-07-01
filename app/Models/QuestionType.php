<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class QuestionType extends Model
{
        use SoftDeletes;
	protected $table = "question_types"; //table name

    
}