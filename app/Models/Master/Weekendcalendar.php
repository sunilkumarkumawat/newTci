<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Weekendcalendar extends Model
{
        use SoftDeletes;
	protected $table = "weekendcalendar"; //table name
	
}