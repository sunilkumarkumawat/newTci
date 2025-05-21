<?php

namespace App\Models;

use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LibraryCabin extends Model
{
    use SoftDeletes;
    protected $table = "library_cabins"; //table name

    protected $guarded = [];

   
}
