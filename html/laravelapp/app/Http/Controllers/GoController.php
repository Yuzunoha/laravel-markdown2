<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoController extends Controller
{
    public function index()
    {
        return [
            'eng' => 'requested!!!',
            'jpn' => 'リクエストが来ましたよ。'
        ];
    }
}
