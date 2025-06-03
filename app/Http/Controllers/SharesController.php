<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommonService;
use Auth;
use Illuminate\Support\Facades\Artisan;
use DB;

class SharesController extends Controller
{
    protected $commonService;

    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }

    // List branches
    public function commonView(Request $request)
    {

      

        $modal = $request->modal_type ?? '';
        $data = $this->commonService->getAll($modal);
        $modal = strtolower($modal); 
        return view($modal.'/view', compact('data'));
    }
    public function branch()
    {
        $data = null;
        return view('branch.add',compact('data'));
    }
    public function role()
    {
        $data = null;
        return view('role.add',compact('data'));
    }
   
    public function expense()
    {
        $data = null;
        return view('expense.add',compact('data'));
    }
    
    public function setting()
    {
        $data = null;
        return view('setting.add',compact('data'));
    }

     public function createCommon(Request $request)
    {
        return $this->commonService->createCommon($request);
    }
     public function changeStatusCommon(Request $request,$modal, $id)
    {
        return $this->commonService->changeStatusCommon($request,$modal, $id);
    }
     public function deleteCommon(Request $request,$modal, $id)
    {
        return $this->commonService->deleteCommon($request,$modal, $id);
    }
public function commonEdit(Request $request,$modal,$id)
    {
        
        $data =  $this->commonService->commonEdit($request,$modal,$id);

        $responseData = $data->getData();

    $data = isset($responseData->data) && !empty($responseData->data)
       ? $responseData->data
        : [];
          
       return view(strtolower($modal) . '/add', compact('data'));
    }  
public function getDependentOptions(Request $request)
    {
        $data =  $this->commonService->getDependentOptions($request);

     return response()->json($data);
     
          
    }  
public function setPermissionView(Request $request,$id)
{
        $roleId = $id;
        // Fetch permissions for the role
        $permissions = DB::table('role_permissions')
            ->where('role_id', $roleId)
            ->pluck('permission')
            ->toArray();

        

        // Prepare data for view
        $permissions = [
            'role_id' => $roleId,
            'permissions' => $permissions,
         
        ];

   

        return view('role.permission',compact('permissions'));

}
public function savePermission(Request $request)
{
 $roleId = $request->role_id;
    $permissions = $request->permissions ?? []; // array of permissions

    // Clear existing permissions for the role
    DB::table('role_permissions')->where('role_id', $roleId)->delete();

    // Prepare insert data
    $insertData = [];
    foreach ($permissions as $permission) {
        $insertData[] = [
            'role_id' => $roleId,
            'permission' => $permission,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    // Insert new permissions
    if (!empty($insertData)) {
        DB::table('role_permissions')->insert($insertData);
    }

    return response()->json(['success' => true, 'message' => 'Permissions saved successfully.']);

}
public function setCurrentBranch(Request $request)
{
    $branchId = $request->input('currentSelectedBranch');

    if ($branchId) {
        // Set session
        session(['currentSelectedBranch' => $branchId]);

        // Find and update user
        $user = \App\Models\User::find(Auth::id());

        if ($user) {
            $user->selectedBranchId = $branchId;
            $user->save();

            // Re-login user with updated info
            Auth::login($user);

              Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'User not found']);
    }

    return response()->json(['status' => 'error', 'message' => 'No branch selected']);
}





}
