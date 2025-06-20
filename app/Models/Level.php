<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;
class Level extends Model
{
       use SoftDeletes;
	protected $table = "levels"; //table name
	
    public function ClassTypes()
    {
        return $this->belongsTo('App\Models\ClassType','class_type_id');
    }
    
}