<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Documents extends Model
{
        use SoftDeletes;
	protected $table = "documents"; //table name
protected $fillable = [
    'user_id',
    'model_name',
    'file_name',
    'file_path',
    'category' // if you are storing category
];
}


