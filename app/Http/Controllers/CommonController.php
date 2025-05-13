<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function branch(){
        return view('branch.branchadd');
    }

    public function role(){
        return view('role.role');
    }
}
