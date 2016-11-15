<?php
namespace App\Traits;

use Response;

define("STATUS_CODE", "statusCode");
define("STATUS_MSG", "statusMsg");
define("DATA", "data");
define("WARNING", "we still not handle this situation");

trait ApiResponse{
    public function res($data, $statusMsg = "success", $statusCode = 200){
        /** change format of response */
        /** if 200, only return data */
        if($statusCode == 200){
            return Response::json($data)->setEncodingOptions(JSON_NUMERIC_CHECK);
        }

        /** for error situation, return code|msg|data */
        return Response::json([
            STATUS_CODE => $statusCode,
            STATUS_MSG => $statusMsg,
            DATA => $data
        ], $statusCode)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
}
