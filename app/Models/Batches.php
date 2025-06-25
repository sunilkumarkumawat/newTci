<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Batches extends Model
{
        use SoftDeletes;
	protected $table = "batches"; //table name
	 protected $guarded = [];
}