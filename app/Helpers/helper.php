<?php
function success($data = [], $code = 200)
{
    $responseData = [
        'result' => true,
    ];

    if ($data) {
        $responseData = array_merge($responseData, [
            'data' => $data
        ]);
    }

    return response()->json($responseData);
}

function failure($message = '', $code = 200, $data = [])
{
    $responseData = [
        'result' => false,
        'msg' => $message,
    ];

    if ($data) {
        $responseData = array_merge($responseData, [
            'data' => $data
        ]);
    }

    return response()->json($responseData, $code);
}

function uploadFileUrl($path)
{
    return $path ? url('sd?path='.$path) : '';
}