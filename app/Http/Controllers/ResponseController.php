<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    function index($status, $status_code = 200, $message, $data = NULL, $action = NULL){
        return response()->json([
            'status' => $status,
            'status_code' => $status_code,
            'message' => $message,
            'data' => $data,
            'action' => $action
        ], $status_code);
    }
}
