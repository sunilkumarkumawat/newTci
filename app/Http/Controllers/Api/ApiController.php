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
use Illuminate\Support\Facades\Storage;



class ApiController extends BaseController
{

    // public function loginAuth(Request $request)
    // {
    //     try {
    //         // Validate incoming request
    //         $request->validate([
    //             'username' => 'required|string',
    //             'password' => 'required|string',
    //         ]);

    //         // Attempt login
    //         if (!Auth::attempt($request->only('username', 'password'))) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Invalid login credentials',
    //                 'data' => null
    //             ], 401); // Unauthorized
    //         }

    //         // Retrieve the authenticated user
    //         $user = Auth::user();

    //         // Check if the user's account is inactive
    //         if ($user->status !== '1') {
    //             Auth::logout();
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Account is inactive or suspended',
    //                 'data' => null
    //             ], 403); // Forbidden
    //         }

    //         // Restrict login for role_id 1 and 4
    //         if (in_array($user->role_id, [1, 4])) {
    //             Auth::logout();
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Access denied for this role',
    //                 'data' => null
    //             ], 403); // Forbidden
    //         }

    //         // Create token
    //         $token = $user->createToken('auth_token')->plainTextToken;

    //         // Retrieve role name
    //         $role = Role::find($user->role_id);
    //         $roleName = $role ? $role->name : null;

    //         // Return success response
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Login successful',
    //             'data' => [
    //                 'access_token' => $token,
    //                 'token_type' => 'Bearer',
    //                 'user_id' => $user->id,
    //                 'roles' => $roleName
    //             ]
    //         ], 200);
    //     } catch (ValidationException $e) {
    //         // Handle validation errors
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Validation failed',
    //             'errors' => $e->errors(),
    //         ], 422);
    //     } catch (\Exception $e) {
    //         // Handle other exceptions
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Login failed',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }


public function getCommonRow(Request $request)
{
    $modal = $request->modal_type;
    $id = $request->id;

    if (!$modal || !$id) {
        return response()->json(['message' => 'modal_type and id are required'], 400);
    }

    if (!str_contains($modal, '\\')) {
        $modal = 'App\\Models\\' . $modal;
    }

    try {
        if (!class_exists($modal)) {
            return response()->json(['message' => 'Invalid modal type'], 400);
        }

        $record = $modal::find($id);

        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        return response()->json([
            'data' => $record
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}

  
}
