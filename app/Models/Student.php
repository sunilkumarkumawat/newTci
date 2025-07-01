<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Student extends Authenticatable
{
        use SoftDeletes;
protected $table = "student"; //table name
	protected $guarded = [];
    
}
