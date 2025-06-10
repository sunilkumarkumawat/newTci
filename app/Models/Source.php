<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Source extends Model
{
        use SoftDeletes;
	protected $table = "source"; //table name
	 protected $guarded = [];
}