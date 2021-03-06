<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($data, $msg = null, $statusCode = 200){
        return response()->json([ 'status'=> 'success', 'msg'=>$msg, 'data'=> $data], $statusCode);
    }

    public function error($msg = null, $statusCode){
        return response()->json([ 'status'=> 'error', 'msg'=>$msg, 'data'=> null], $statusCode);
    }

}
