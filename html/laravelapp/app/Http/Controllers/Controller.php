<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseJson(array $data, int $code = 200)
    {
        $headers = [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ];
        return response()->json(
            $data,
            $code,
            $headers,
            JSON_UNESCAPED_UNICODE
        );
    }
}
