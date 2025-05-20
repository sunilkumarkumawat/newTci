<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommonService;

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
          
        return view($modal.'/add',compact('data'));
    }



    
}
