<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillCounter extends Model
{

    protected $table = "bill_counter"; // Table name

    // Allow all fields to be mass assignable
    protected $guarded = [];

}
