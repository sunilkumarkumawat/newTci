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

class ExpenseController extends Controller

{
   
// public function expenseedit($id)
// {
//     try {
//         $api = new ApiController();

//         $fakeRequest = new Request([
//             'modal_type' => 'Expense',
//             'id' => $id,
//         ]);

//         $response = $api->getCommonRow($fakeRequest);
//         $responseData = $response->getData();
//         $data = isset($responseData->data) && !empty($responseData->data) ? $responseData->data : null;

//         $expenseData = $this->getExpenseData();

//         return view('expense.expense', [
//             'data' => $data,
//             'expenseData' => $expenseData
//         ]);
//     } catch (\Exception $e) {
//         return view('expense.expense', [
//             'data' => null,
//             'expenseData' => [],
//         ])->with('error', 'Failed to edit expense.');
//     }
// }

// private function getExpenseData()
// {
//     $api = new ApiController();

//     $fakeRequest = new Request([
//         'modal_type' => 'Expense',
//     ]);

//     $response = $api->getUsersData($fakeRequest);

//     $responseData = $response->getData();

//     return isset($responseData->data) && !empty($responseData->data)
//         ? $responseData->data
//         : [];
// }




}
