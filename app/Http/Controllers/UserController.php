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
use App\Http\Controllers\api\ApiController;

class UserController extends Controller

{
    public function userAdd()
    {

        return view('user/userAdd',['data'=>null]);
    }
    public function userView()
    {
        try {
            // Create a new instance of the API controller
            $api = new ApiController();

            // Simulate request with modal_type = User
            $fakeRequest = new Request([
                'modal_type' => 'User',
            ]);

            // Call the API method
            $response = $api->getUsersData($fakeRequest);

            // Extract data from JSON response
            $responseData = $response->getData();

            // Check if data exists and is not empty
            $data = isset($responseData->data) && !empty($responseData->data) ? $responseData->data : [];
            // Return view with users
            return view('user.userView', ['data' => $data]);
        } catch (\Exception $e) {
            // Log the error and show fallback view or message

            return view('user.userView', ['data' => []])
                ->with('error', 'Failed to load users.');
        }
    }

    public function userEdit($id)
    {

             $api = new ApiController();

            // Simulate request with modal_type = User
            $fakeRequest = new Request([
                'modal_type' => 'User',
                'id' => $id,
            ]);

            // Call the API method
            $response = $api->getCommonRow($fakeRequest);

            // Extract data from JSON response
            $responseData = $response->getData();

              // Check if data exists and is not empty
            $data = isset($responseData->data) && !empty($responseData->data) ? $responseData->data : [];

        return view('user.userAdd',['data'=>$data]);
    }

    public function teacherView()
    {
        return view('teacher/teacherView');
    }
}
