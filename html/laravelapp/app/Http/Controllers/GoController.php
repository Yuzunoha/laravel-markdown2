<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoController extends Controller
{
    public function index(Request $request)
    {
        $file = $request->file("file");
        $size = filesize($file);
        $data = [
            'request' => $request,
            'file' => $file,
            'size' => $size,
        ];
        return $this->responseJson($data);
    }

    public function test(Request $request)
    {
        return "testです。";
    }
}
