<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use File;
use App;
use URL;
use Image;
use Carbon;
use Str;
use App\Helpers\helpers;
use Mail;


class ApiController extends BaseController
{

    public function loginAuth(Request $request)
    {
        try {
            // Validate incoming request
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            // Attempt login
            if (!Auth::attempt($request->only('username', 'password'))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid login credentials',
                    'data' => null
                ], 401); // Unauthorized
            }

            // Retrieve the authenticated user
            $user = Auth::user();

            // Check if the user's account is inactive
            if ($user->status !== '1') {
                Auth::logout();
                return response()->json([
                    'status' => false,
                    'message' => 'Account is inactive or suspended',
                    'data' => null
                ], 403); // Forbidden
            }

            // Restrict login for role_id 1 and 4
            if (in_array($user->role_id, [1, 4])) {
                Auth::logout();
                return response()->json([
                    'status' => false,
                    'message' => 'Access denied for this role',
                    'data' => null
                ], 403); // Forbidden
            }

            // Create token
            $token = $user->createToken('auth_token')->plainTextToken;

            // Retrieve role name
            $role = Role::find($user->role_id);
            $roleName = $role ? $role->name : null;

            // Return success response
            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'data' => [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user_id' => $user->id,
                    'roles' => $roleName
                ]
            ], 200);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            // Handle other exceptions
            return response()->json([
                'status' => false,
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function createCommon(Request $request)
    {

        $data = collect($request->all())->except('modal_type')->toArray();

        $modal = $request->modal_type;

        if (!str_contains($modal, '\\')) {
            $modal = 'App\\Models\\' . $modal;
        }
        try {

            //dd(!class_exists($modal));
            // Check if the class exists before trying to create
            if (!class_exists($modal)) {
                return response()->json(['message' => 'Invalid modal type'], 400);
            }

            // Create the record dynamically
            $record = $modal::create($data);

            return response()->json([
                'message' => class_basename($modal) . ' created successfully.',
                'data' => $record
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }


    
    public function deleteCommon(Request $request, $model, $id)
{
    try {
        // If the model string does not include a namespace, prepend App\Models\
        if (!str_contains($model, '\\')) {
            $model = 'App\\Models\\' . $model;
        }

        if (!class_exists($model)) {
            return response()->json(['message' => 'Invalid model type'], 400);
        }

        // Attempt to find and delete the record
        $record = $model::find($id);

        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $record->delete();

        return response()->json([
            'message' => class_basename($model) . ' deleted successfully.',
            'data' => $record
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}




    

     public function getUsersData(Request $request)
{
    try {
        $modal = $request->modal_type;

        // Automatically add namespace if not fully qualified
        if (!str_contains($modal, '\\')) {
            $modal = 'App\\Models\\' . $modal;
        }

        // Check if the model class exists
        if (!class_exists($modal)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid model type provided.'
            ], 400); // 400 = Bad Request
        }

        // Retrieve all records
        $records = $modal::all();

        if ($records->isEmpty()) {
            return response()->json([
                'status' => true,
                'message' => class_basename($modal) . ' data not found.',
                'data' => []
            ], 204); // 204 = No Content (success but no data)
        }

        return response()->json([
            'status' => true,
            'message' => class_basename($modal) . ' data fetched successfully.',
            'data' => $records
        ], 200); // 200 = OK

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Server Error: ' . $e->getMessage()
        ], 500); // 500 = Internal Server Error
    }
}
}
