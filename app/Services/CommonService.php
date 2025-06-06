<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Auth;
use DB;
use Session;
class CommonService
{


    private function savePermission($userId, array $permissions = [])
{

   
    // Clear existing permissions for the role
    DB::table('user_permissions')->where('user_id', $userId)->delete();




    // Prepare insert data
    $insertData = [];
    foreach ($permissions as $permission) {
        $insertData[] = [
            'user_id' => $userId,
            'permission' => $permission,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    // Insert new permissions
    if (!empty($insertData)) {
        DB::table('user_permissions')->insert($insertData);
    }

    return true;
}
public function createCommon($request)
{
    $data = collect($request->all())->except(['modal_type', 'id'])->toArray();
    $modal = $request->modal_type;

    
    if (!str_contains($modal, '\\')) {
        $modal = 'App\\Models\\' . $modal;
    }

    try {
        if (!class_exists($modal)) {
            return response()->json(['message' => 'Invalid modal type'], 400);
        }

    $modalName = class_basename($modal);

// 🔐 Handle password field
$this->handlePasswordField($data);


  $permissions = null; // Initialize permissions variable
// 🧹 Unset permissions if User model
if ($modalName === 'User' && isset($data['permissions'])) {
    $permissions = $data['permissions']; // Save temporarily
    unset($data['permissions']);
}

// 📂 Handle uploaded files
foreach ($request->allFiles() as $key => $file) {
    if ($file->isValid()) {
        $data[$key] = $this->handleFileUpload($file, $modalName);
    }
}

// ✅ Update if ID exists
if ($request->filled('id')) {
    $record = $modal::find($request->id);
    if (!$record) {
        return response()->json(['message' => $modalName . ' not found.'], 404);
    }

    $record->update($data);

    // 🔗 Save permissions
    if ($modalName === 'User' && isset($permissions)) {
      $this->savePermission($record->id, $permissions ?? []);
    }

    Cache::forget('getAll_' . $modalName);

    return response()->json([
        'message' => $modalName . ' updated successfully.',
        'data' => $record,
        'modal' => $modalName,
        'method' => 'update'
    ]);
} else {
    $record = $modal::create($data);

    // 🔗 Save permissions
    if ($modalName === 'User' && isset($permissions)) {
       $this->savePermission($record->id, $permissions ?? []);
    }

    Cache::forget('getAll_' . $modalName);

    return response()->json([
        'message' => $modalName . ' created successfully.',
        'data' => $record,
        'modal' => $modalName,
        'method' => 'create'
    ], 201);
}
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}


    public function deleteCommon(Request $request, $modal, $id)
    {
        try {
            if (!str_contains($modal, '\\')) {
                $modal = 'App\\Models\\' . $modal;
            }

            if (!class_exists($modal)) {
                return response()->json(['message' => 'Invalid modal type'], 400);
            }

                 $modalName = class_basename($modal);

            $record = $modal::find($id);

            if (!$record) {
                return response()->json(['message' => 'Record not found'], 404);
            }

            $record->delete();


             Cache::forget('getAll_' . $modalName);
            return response()->json([
                'message' => class_basename($modal) . ' deleted successfully.',
                'data' => $record
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function changeStatusCommon(Request $request, $modal, $id)
    {
        try {
            if (!str_contains($modal, '\\')) {
                $modal = 'App\\Models\\' . $modal;
            }

            if (!class_exists($modal)) {
                return response()->json(['message' => 'Invalid modal type'], 400);
            }

            $record = $modal::find($id);

            if (!$record) {
                return response()->json(['message' => 'Record not found'], 404);
            }

            $record->status = $record->status == 1 ? 0 : 1;
            $record->save();

            return response()->json([
                'message' => class_basename($modal) . ' status changed successfully.',
                'data' => [
                    'id' => $record->id,
                    'status' => $record->status
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }



public function getAll(string $modal)
{
    if (!$modal) {
        throw new \InvalidArgumentException('modal_type is required');
    }

    // Save the base model name for later comparisons
    $baseModalName = $modal;

    // Append full namespace if not provided
    if (!str_contains($modal, '\\')) {
        $modal = 'App\\Models\\' . $modal;
    }

    // Check if the model class exists
    if (!class_exists($modal)) {
        throw new \InvalidArgumentException('Invalid modal type');
    }

    $cacheKey = 'getAll_' . class_basename($modal);

    return Cache::remember($cacheKey, 60, function () use ($modal, $baseModalName) {
        $query = $modal::orderBy('id', 'desc');

        // Skip branch filtering for 'branch' and 'role' models
        if (!in_array($baseModalName, ['Branch', 'Role'])) {
            if (Auth::check()) {
                $user = Auth::user();
                if ($user->role_id != 1) {
                    $query->where('branch_id', $user->selectedBranchId);
                } elseif ($user->role_id == 1 && $user->selectedBranchId !== null && $user->selectedBranchId !== '' && $user->selectedBranchId != -1) {
                    $query->where('branch_id', $user->selectedBranchId);
                }
            }
        }

        return $query->where('session_id',Session::get('current_session'))->get();
    });
}
    private function handlePasswordField(&$data)
    {
        if (isset($data['password'])) {
            $data['confirm_password'] = $data['password'];
            $data['password'] = bcrypt($data['password']);
        }
    }

    private function handleFileUpload($file, $folder = 'uploads')
    {
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/' . $folder, $filename);

      
        return str_replace('public/', 'storage/app/public/', $path);
    }

     public function commonEdit(Request $request,$modal,$id)
    {
        $modal = $modal;
        $id = $id;

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


    public function getDependentOptions($request)
{
    $modal = $request->input('modal');    // e.g., City
    $field = $request->input('field');    // e.g., state_id
    $value = $request->input('value');    // selected state_id value




  
    if (!class_exists($modelClass = "\\App\\Models\\$modal")) {
        return response()->json([], 400);
    }


    $options = $modelClass::where($field, $value)->pluck('name', 'id');

    return $options;
}
}
