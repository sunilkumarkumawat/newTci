<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
class CommonService
{
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

            // ❌ Clear cache after update
            Cache::forget('getAll_' . $modalName);

            return response()->json([
                'message' => $modalName . ' updated successfully.',
                'data' => $record
            ]);
        } else {
            $record = $modal::create($data);

            // ❌ Clear cache after create
            Cache::forget('getAll_' . $modalName);

            return response()->json([
                'message' => $modalName . ' created successfully.',
                'data' => $record
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

            $record = $modal::find($id);

            if (!$record) {
                return response()->json(['message' => 'Record not found'], 404);
            }

            $record->delete();

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

    if (!str_contains($modal, '\\')) {
        $modal = 'App\\Models\\' . $modal;
    }

    if (!class_exists($modal)) {
        throw new \InvalidArgumentException('Invalid modal type');
    }

    $cacheKey = 'getAll_' . class_basename($modal);

    // Cache data for 60 minutes, ordered by id descending
    return Cache::remember($cacheKey, 60, function () use ($modal) {
        return $modal::orderBy('id', 'desc')->get();
    });
}

    private function handlePasswordField(&$data)
    {
        if (isset($data['password'])) {
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
}
