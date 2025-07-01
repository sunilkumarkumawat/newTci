<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestScheduleController extends Controller
{
    public function createNewTest(){
        return view('testSchedular.createNewTest');
    }
}