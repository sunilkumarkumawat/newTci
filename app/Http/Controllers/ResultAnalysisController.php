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
   public function subjectWiseReport()
{
    $subjectData = [
        'Physics' => [
            ['chapter' => 'Laws of Motion', 'average' => 65],
            ['chapter' => 'Gravitation', 'average' => 38],
            ['chapter' => 'Work & Energy', 'average' => 52],
        ],
        'Chemistry' => [
            ['chapter' => 'Atomic Structure', 'average' => 72],
            ['chapter' => 'Periodic Table', 'average' => 59],
            ['chapter' => 'Acids & Bases', 'average' => 32],
        ],
        'Math' => [
            ['chapter' => 'Algebra', 'average' => 82],
            ['chapter' => 'Trigonometry', 'average' => 36],
            ['chapter' => 'Calculus', 'average' => 44],
        ],
    ];

    return view('resultAnalysis.subjectWiseReport', compact('subjectData'));
}

public function batchWiseComparison(){
        return view('resultAnalysis.batchWiseComparison');
    }

public function timeBasedPerformance(){
        return view('resultAnalysis.timeBasedPerformance');
    }
public function examAnalysis(){
        return view('resultAnalysis.examAnalysis');
    }


   
}
