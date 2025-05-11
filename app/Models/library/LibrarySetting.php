<?php

namespace App\Models\library;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LibrarySetting extends Model
{
        use SoftDeletes;
	protected $table = "library_settings"; //table name

}