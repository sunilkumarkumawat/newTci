<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function bookadd(){
        return view('Bookmanagement.bookadd');
    }

    public function bookassign(){
        return view('Bookmanagement.bookAssign');
    }
}
