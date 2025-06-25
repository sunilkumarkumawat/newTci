<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Validator; 
use App\Models\User;
use App\Models\Master\Role;
use App\Models\PermissionManagement;
use App\Models\BillCounter;
use App\Models\SmsSetting;
use App\Models\Setting;
use App\Models\WhatsappSetting;
use App\Models\Master\MessageTemplate;
use App\Models\City;
use App\Models\Master\Branch;
use App\Models\Master\MessageContent;
use App\Jobs\Job;
use App\Models\Teacher;
use App\Models\TeacherDocuments;
use Session;
use Hash;
use Str;
use Helper;
use File;
use Redirect;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller

{
    public function messageTypeAdd(){
                     
        return view('message/messageTypeAdd');
 
    }
    public function messageTemplate(){
                     
        return view('message/messageTemplate');
 
    }
   
    
       
}