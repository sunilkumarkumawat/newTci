<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentAction extends Model
{
        use SoftDeletes;
        protected $table = "student_action"; // Table name

        // Allow all fields to be mass assignable
        protected $guarded = [];
}
