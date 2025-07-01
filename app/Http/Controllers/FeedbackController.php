<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function allFeedbackDoubt(){
        return view('feedbackDoubt.allFeedbackDoubt');
    }

    public function viewDoubt(){
        return view('feedbackDoubt.viewDoubt');
    }

     public function feedbackAnalytics(){
        return view('feedbackDoubt.feedbackAnalytics');
    }
     public function archiveExport(){
        return view('feedbackDoubt.archiveExport');
    }
}