<?php

namespace App\Models;

use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $table = "role"; // Table name

      // Allow all fields to be mass assignable
    protected $guarded = [];

    public static function countRole()
    {
        return self::whereNull('deleted_at')
            ->where('session_id', Session::get('session_id'))
            ->where('branch_id', Session::get('branch_id'))
            ->count();
    }
}
