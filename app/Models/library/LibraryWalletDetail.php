<?php

namespace App\Models\library;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LibraryWalletDetail extends Model
{
        use SoftDeletes;
	protected $table = "library_wallet_details"; //table name

}