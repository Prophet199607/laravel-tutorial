<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Service;

class ServiceController extends Controller
{
    public function store(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'serial_no' => 'required|unique:services,InvNo',
            'customer_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Duplicate Serial No', 
                'http_status' => 500, 
                'success' => false
            ], 500);
        }

        Service::create(['InvNo' => $request->serial_no, 'CustomerCode' => $request->customer_id]);

        $data = [
            'serial_no' => $request->serial_no,
            'customer_id' => $request->customer_id,
            'dispenser_service_items' => $request->dispenser_service_item,
        ];
        return response()->json([
            'data' => $data,
            'error' => 'Service has been created',
            'http_status' => 200,
            'http_status_message' => "OK",
            'msg' => 'Service has been created',
            'success' => true,
        ], 200);
    }
}
