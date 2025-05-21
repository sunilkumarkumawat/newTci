<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

Class LibraryController extends Controller

{

    public function cabin(){
        return view('librarycabin.cabin');
    }

    public function locker(){
        return view('library_management.locker');
    }

    public function timeslot(){
        return view('library_management.timeslot');
    }

   public function billadd(){
    return view('library_management.billing');
   }

   public function subscription(){
    return view('library_management.subscription');
   }

   public function duefees(){
    return view('library_management.due');
   }

   public function wallet(){
    return view('library_management.wallet');
   }

   public function walletlist(){
    return view('library_management.walletlist');
   }

   public function print(){
    return view('printfiles.print');
   }
}