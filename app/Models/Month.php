<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Month extends Model
{
        use SoftDeletes;
	protected $table = "months"; //table name
    
    
}