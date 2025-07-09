<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Validator;
use App\Models\Student;
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
use App\Http\Controllers\Api\ApiController;

class StudentController extends Controller

{
    public function studentAdd()
    {
        return view('student.add');
    }

    public function studentView(Request $request)
    {
        try {
            // Create a new instance of the API controller
            $uploadedIds = $request->query('uploadedIds'); // returns string: "21,22,23"

            // Optional: Convert to array if needed
            $uploadedIdArray = $uploadedIds ? explode(',', $uploadedIds) : [];
            // Simulate request with modal_type = User
            // $fakeRequest = new Request([
            //     'modal_type' => 'Admission',
            // ]);

            // // Call the API method
            // $response = $api->getUsersData($fakeRequest);

            // // Extract data from JSON response
            // $responseData = $response->getData();

            // // Check if data exists and is not empty
            // $data = isset($responseData->data) && !empty($responseData->data) ? $responseData->data : [];
            $data = Student::whereIn('id', $uploadedIdArray)
                ->get();
// dd($data);
            // If no data found, return empty array
            if ($data->isEmpty()) {
                $data = [];
            }
           
            // Return view with students
            return view('student.studentView', ['data' => $data]);
        } catch (\Exception $e) {
            // Log the error and show fallback view or message

            return view('student.studentView', ['data' => []])
                ->with('error', 'Failed to load students.');
        }
    }

    public function studentEdit($id)
    {

        $api = new ApiController();

        // Simulate request with modal_type = User
        $fakeRequest = new Request([
            'modal_type' => 'Student',
            'id' => $id,
        ]);

        // Call the API method
        $response = $api->getCommonRow($fakeRequest);

        // Extract data from JSON response
        $responseData = $response->getData();

        // Check if data exists and is not empty
        $data = isset($responseData->data) && !empty($responseData->data) ? $responseData->data : [];

        return view('student.add', ['student' => $data]);
    }




    public function showForm()
    {
        return view('student.admitCard');
    }
}
