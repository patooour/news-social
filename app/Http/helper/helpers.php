<?php


    if (!function_exists('apiSuccessResponse')) {
        function apiSuccessResponse($status = null , $message = null , $data = null)
        {
            $response = [
                'status' => $status ,
                'message' => $message,
            ];
            if ($data != null) {
                $response['data'] = $data;
            }
            return response()->json($response);
        }
    }

