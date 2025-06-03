<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;

    protected $table = "branch"; // Table name

    // Allow all fields to be mass assignable
    protected $guarded = [];
}
