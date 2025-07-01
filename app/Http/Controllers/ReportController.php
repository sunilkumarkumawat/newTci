<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function facultyreport()
    {
        return view('Reports/facultyreport');
    }

    public function timeAnalysis()
    {
        return view('Reports/timeAnalysis');
    }

    public function doubtSolution()
    {
        return view('Reports/feedbackdoubt');
    }

     public function attendencereport()
    {
        return view('Reports/testattendence');
    }

     public function customreport()
    {
        return view('Reports/custom');
    }
}
