<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ExamDraft extends Model
{
        use SoftDeletes;
	protected $table = "exam_drafts"; //table name
        protected $guarded = [];
}