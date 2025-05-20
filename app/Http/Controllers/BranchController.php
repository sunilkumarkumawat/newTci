<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;

class BranchController extends Controller
{
    // Show create branch form with data list
    public function branch()
    {
        try {
            $branchData = $this->getBranchData();

            return view('branch.branchadd', [
                'data' => null, // for create mode
                'branchData' => $branchData
            ]);
        } catch (\Exception $e) {
            return view('branch.branchadd', [
                'data' => null,
                'branchData' => []
            ])->with('error', 'Failed to load branch data.');
        }
    }

    // Show edit form for specific branch
    public function branchedit($id)
    {
        try {
            $api = new ApiController();

            $fakeRequest = new Request([
                'modal_type' => 'Branch',
                'id' => $id,
            ]);

            $response = $api->getCommonRow($fakeRequest);
            $responseData = $response->getData();

            $data = isset($responseData->data) && !empty($responseData->data) ? $responseData->data : null;

            $branchData = $this->getBranchData();

            return view('branch.branchadd', [
                'data' => $data,
                'branchData' => $branchData
            ]);
        } catch (\Exception $e) {
            return view('branch.branchadd', [
                'data' => null,
                'branchData' => []
            ])->with('error', 'Failed to edit branch.');
        }
    }

    // Common method to fetch all branch records
    private function getBranchData()
    {
        $api = new ApiController();

        $fakeRequest = new Request([
            'modal_type' => 'Branch',
        ]);

        $response = $api->getUsersData($fakeRequest);
        $responseData = $response->getData();

        return isset($responseData->data) && !empty($responseData->data)
            ? $responseData->data
            : [];
    }

    public function branchview(){
        return view('branch.view');
    }
}
