<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Session;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


   public function index()
{
    // Authenticated user object
    $user = Auth::user();

    // Optional: check if user is null
    if (!$user) {
        return redirect('/login'); // or return error
    }


    return view('dashboard', compact('user')); // pass user to Blade
}
}
