<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        return view('Reports.index');
    }

    public function getReportData(Request $request){

        if($request->post()){
            $report_data = [
                [
                    'id' => 1,
                    'name' => 'Rahul Sharma',
                    'admission_no' => '1023',
                    'class' => '10th',
                    'batch' => '10th',
                    'section' => 'A',
                    'dob' => '2008-05-14',
                    'gender' => 'Male',
                    'email' => 'rahul@example.com',
                    'phone' => '9876543210',
                    'exam_date' => '2008-05-14',
                    'exam_name' => 'Test1',
                    'total_questions' => '50',
                    'attempted' => '35',
                    'correct' => '30',
                    'incorrect' => '5',
                    'unattempted' => '15',
                    'marks_scored' => '140',
                    'accuracy' => '86.1%',
                    'time_taken' => '2 hrs 45 mins',
                ],
                [
                    'id' => 2,
                    'name' => 'Priya Mehta',
                    'admission_no' => '1024',
                    'class' => '10th',
                    'batch' => '10th',
                    'section' => 'B',
                    'dob' => '2008-07-22',
                    'gender' => 'Female',
                    'email' => 'priya@example.com',
                    'phone' => '9876512345',
                    'exam_date' => '2008-05-14',
                    'exam_name' => 'Test2',
                    'total_questions' => '50',
                    'attempted' => '35',
                    'correct' => '30',
                    'incorrect' => '5',
                    'unattempted' => '15',
                    'marks_scored' => '140',
                    'accuracy' => '86.1%',
                    'time_taken' => '2 hrs 45 mins',
                ],
            ];
            // dd($report_data);
            return view('Reports.student_wise_marks', compact('report_data'));
        }else{
            return "No Record Found!";
        }
    }

    
}
