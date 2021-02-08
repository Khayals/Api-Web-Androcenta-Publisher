<?php


namespace App\Helper;


class ResponseHelper
{
    public function successMessage($message) {
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function successData($message,$key,$data) {
        return response()->json([
            'status' => true,
            'message' => $message,
            $key => $data
        ]);
    }

    public function failMessage($status,$message) {
        return response()->json([
            'status' => false,
            'message' => $message
        ],$status);
    }
}
