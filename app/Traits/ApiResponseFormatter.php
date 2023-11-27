<?php

namespace app\Traits;

//Formatting Response
trait ApiResponseFormatter{
    
    public function apiResponse($code = 200, $message = "Success", $data = []){
        //dari parameter akan diformat menjadi seperti ini :
            return json_encode([
                "code" => $code,
                "message" => $message,
                "data" => $data
            ]);
    }
}