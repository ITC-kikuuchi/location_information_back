<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * AuthController コンストラクタ
     * AuthService の依存性を注入する
     *
     * @param AuthService $authService
     */
    public function __construct(protected AuthService $authService)
    {
    }

    /**
     * ログインAPI
     */
    public function login()
    {
        //
    }

    /**
     * ログイン情報取得API
     */
    public function me()
    {
        //
    }

    /**
     * ログアウトAPI
     */
    public function logout()
    {
        //
    }
}
