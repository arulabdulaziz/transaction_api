<?php

namespace App\Helper;
use \App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class Response
{
    public static function jsonError($status, $errorCode, $message, $messageId)
    {
        return response()->json(['success' => false, 'errors' => [
            'status' => $status,
            'errorCode' => $errorCode,
            'message' => $message,
            'messageId' => $messageId,
        ]], $status);
    }
    public static function jsonErrorWithData($status, $errorCode, $message, $messageId, $data)
    {
        return response()->json(['success' => false, 'errors' => [
            'status' => $status,
            'errorCode' => $errorCode,
            'message' => $message,
            'messageId' => $messageId,
            'data' => $data,
        ]], $status);
    }
    public static function jsonErrorValidation($validator)
    {
        // return Response::jsonErrorSimple(
        //     Controller::BAD_REQUEST_STATUS,
        //     Controller::INCORRECT_DATA,
        //     $validator->errors()->first(),
        //     $validator->errors()->first());
        return Response::jsonErrorSimple(
            Controller::BAD_REQUEST_STATUS,
            Controller::INCORRECT_DATA,
            $validator->errors()->first(),
            $validator->errors()->first()
        );
    }
    public static function jsonSuccess($success, $array, $object)
    {
        $result['data_array'] = $array;
        $result['data_object'] = $object;
        if ($array == null) {
            $result['data_array'] = [];
        }
        if ($object == null) {
            $result['data_object'] = json_decode("{}");
        }
        Log::debug("RESULT" . json_encode($result));

        return response()->json(['success' => $success, 'result' => $result], Controller::SUCCESS_STATUS);
    }
    public static function jsonSuccessResult($success, $result)
    {
        return response()->json(['success' => $success, 'result' => $result], Controller::SUCCESS_STATUS);
    }

    public static function jsonSuccessResultCustom($success, $result, $key, $value)
    {
        return response()->json(['success' => $success, 'result' => $result, $key => $value], Controller::SUCCESS_STATUS);
    }
    public static function jsonSuccessSimple($success, $data)
    {
        $result = $data;
        if (is_array($data)) {
            if ($data == null) {
                $result = [];
            }
        } else {
            if ($data == null) {
                $result = json_decode("{}");
            }
        }
        Log::debug("RESULT" . json_encode($result));

        return response()->json(['success' => $success, 'data' => $result], Controller::SUCCESS_STATUS);
    }

    public static function jsonErrorSimple($status, $errorCode, $message, $messageId)
    {
        //This is for backward compatible
        if (request()->header('type') == "android" && request()->header('code') <= 3) {
            return response()->json(['success' => false, 'errors' => [
                'status' => $status,
                'errorCode' => $errorCode,
                'message' => $message,
                'messageId' => $messageId,
            ]], $status);
        }

        return response()->json(['success' => false, 'errors' => [[
            'status' => $status,
            'errorCode' => $errorCode,
            'message' => $message,
            'messageId' => $messageId,
        ]]], $status);
    }

    public static function jsonErrorValidationSimple($validator)
    {
        return Response::jsonErrorSimple(
            Controller::BAD_REQUEST_STATUS,
            Controller::INCORRECT_DATA,
            $validator->errors()->first(),
            $validator->errors()->first()
        );
    }
}
