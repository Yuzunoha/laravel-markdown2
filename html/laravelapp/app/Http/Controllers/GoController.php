<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoController extends Controller
{
    public function index()
    {
        $data = [
            'eng' => 'requested!!!',
            'jpn' => 'リクエストが来ましたよ。'
        ];
        return $this->responseJson($data);
    }
}
