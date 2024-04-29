<?php

namespace App\Helpers;

class ApiFormat{
    protected static $respose = [
        'meta'=>[
            'code'=>null,
            'status'=>false,
            'message'=>null,
        ],
        'data'=>null,
    ];

    public static function buatApiFormat($code = null,$status = false,$message = null,$data = null){
        self::$respose['meta']['code'] = $code;
        self::$respose['meta']['status'] = $status;
        self::$respose['meta']['message'] = $message;
        self::$respose['data'] = $data;

        return response()->json(self::$respose,self::$respose['meta']['code']);
    }
}