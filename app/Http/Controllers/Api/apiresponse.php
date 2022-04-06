<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\apiresponse;


trait apiresponse 
{
    public function apiresponse($data=null,$status=200,$msg=null){
        $array = [
            'data'   => $data , 
            'status' => $status,
            'msg'    => $msg,
        ];
        return response($array);
    }
}