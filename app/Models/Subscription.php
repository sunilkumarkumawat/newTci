<?php

namespace App\Models;

use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
        use SoftDeletes;
        protected $table = "library_time_slots"; //table name

        protected $guarded = [];
}
