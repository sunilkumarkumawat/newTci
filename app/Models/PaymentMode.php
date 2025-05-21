<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
class PaymentMode extends Model
{
        use SoftDeletes;
protected $table = "payment_modes"; //table name

}
