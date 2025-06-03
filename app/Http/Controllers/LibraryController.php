<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

Class LibraryController extends Controller

{

    public function cabin(){
        return view('librarycabin.cabin');
    }

    public function locker(){
        return view('librarycabin.locker');
    }

   public function billadd(){
    return view('librarycabin.billing');
   }

   public function subscription(){
    return view('librarycabin.subscription');
   }

   public function duefees(){
    return view('librarycabin.due');
   }

   public function wallet(){
    return view('librarycabin.wallet');
   }

   public function walletlist(){
    return view('librarycabin.walletlist');
   }

   public function print(){
    return view('printfiles.print');
   }
}