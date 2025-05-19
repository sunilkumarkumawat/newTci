<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/loginAuth', function (Request $request) {
    $user = User::where('username', $request->user_name)->first();


    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Laravel login to create session (for Blade)
    Auth::login($user); // ✅ session-based login

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json(['user' => $user, 'token' => $token], 200);
});



Route::middleware('auth:sanctum')->group(function () {

Route::delete('/common-delete/{model}/{id}', [ApiController::class, 'deleteCommon']);
Route::post('/common-status-change/{model}/{id}', [ApiController::class, 'changeStatusCommon']);

    Route::post('createCommon', [ApiController::class, 'createCommon']);
});
