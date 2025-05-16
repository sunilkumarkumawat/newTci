<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\api\ApiController;

class CommonController extends Controller
{
    public function branch()
    {
        try {
            // Create a new instance of the API controller
            $api = new ApiController();

            // Simulate request with modal_type = User
            $fakeRequest = new Request([
                'modal_type' => 'Branch',
            ]);

            // Call the API method
            $response = $api->getUsersData($fakeRequest);

            // Extract data from JSON response
            $responseData = $response->getData();

            // Check if data exists and is not empty
            $data = isset($responseData->data) && !empty($responseData->data) ? $responseData->data : [];

            // Return view with users
            return view('branch/branchadd', ['data' => $data]);
        } catch (\Exception $e) {
            // Log the error and show fallback view or message

            return view('branch/branchadd', ['data' => []])
                ->with('error', 'Failed to load branch.');
        }
    }

    public function role()
    {
        try {
            // Create a new instance of the API controller
            $api = new ApiController();

            // Simulate request with modal_type = User
            $fakeRequest = new Request([
                'modal_type' => 'Role',
            ]);

            // Call the API method
            $response = $api->getUsersData($fakeRequest);

            // Extract data from JSON response
            $responseData = $response->getData();

            // Check if data exists and is not empty
            $data = isset($responseData->data) && !empty($responseData->data) ? $responseData->data : [];

            // Return view with users
            return view('role/role', ['data' => $data]);
        } catch (\Exception $e) {
            // Log the error and show fallback view or message

            return view('role/role', ['data' => []])
                ->with('error', 'Failed to load expense.');
        }
    }
}
