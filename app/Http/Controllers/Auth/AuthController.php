<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Admission;
use App\Models\Testing;
use App\Models\State;
use App\Models\IPSetting;
use App\Models\OtpRequest;
use App\Models\WhatsappApiResponse;
use App\Models\BirthdayWishes;
use App\Models\CronJobs;
use App\Models\Setting;
use App\Models\Master\Sessions;
use App\Models\Master\Branch;
use App\Models\BillCounter;
use App\Models\PermissionManagement;
use App\Models\Master\MessageTemplate;
use App\Models\Master\MessageType;
use Illuminate\Validation\Validator; 
use App\Helpers\helper;
use Session;
use Hash;
use Str;
use Redirect;
use Auth;
use DB;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;


class AuthController extends Controller
{
    

    public function getLogin(Request $request){
        return view('auth/login');
    }
	public function logout() {
          Auth::logout();
          Session::flush();
          return redirect("login")->with('message','Logout successfully!'); 
    }

    public function sidebar(){
        return view('layout/sidebar');
    }
}
