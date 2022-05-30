<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * ログインユーザのトークンを新規発行する
     * 当該ユーザの過去のトークンは全て破棄する
     */
    public function codegymToken()
    {
        /* ログインユーザを取得する */
        $user = Auth::user();

        /* 1ユーザにつき有効なトークンは1つだけにする */
        $user->tokens()->delete();

        /* トークンを発行する */
        $token = $user->createToken('token-name');

        /* トークンを返却する */
        return $token->plainTextToken;
    }
}
