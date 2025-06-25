<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultAnalysisController extends Controller
{
    public function dashboard(){
        return view('resultAnalysis.dashboard');
    }
    public function testWiseReport(){
        return view('resultAnalysis.testWiseReport');
    }
    public function studentWiseReport(){
        return view('resultAnalysis.studentWiseReport');
    }

   
}
