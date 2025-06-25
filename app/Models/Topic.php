<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;
class Topic extends Model
{
       use SoftDeletes;
	protected $table = "topics"; //table name

    protected $guarded = [];

    public function ClassTypes()
    {
        return $this->belongsTo('App\Models\ClassType','class_type_id');
    }

    public function Subject()
    {
        return $this->belongsTo('App\Models\Subject','subject_id');
    }
    
    public function Chapter()
    {
        return $this->belongsTo('App\Models\exam\digital\Chapter','chapter_id');
    }
}