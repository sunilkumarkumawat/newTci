<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Suka extends Model
{
        use SoftDeletes;
	protected $table = "sukas"; //table name

    
}