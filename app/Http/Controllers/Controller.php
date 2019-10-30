<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function error_message($code, $errors){
        $data = [
            'status' => 'error',
            'code'   => $code,
            'errors' => $errors   
        ];
        
        return response()->json($data);
    }

    public function good_message($code, $message){
        $data = [
            'status'    => 'success',
            'code'      => $code,
            'message'   => $message,
        ];

        return response()->json($data);
    }
}
