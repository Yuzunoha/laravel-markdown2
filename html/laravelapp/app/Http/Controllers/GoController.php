<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->toArray();
        return $this->responseJson($data);
    }
}
