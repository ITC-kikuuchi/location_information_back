<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
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
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->authService->login($request);
    }

    /**
     * ログイン情報取得API
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return $this->authService->me();
    }

    /**
     * ログアウトAPI
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        return $this->authService->logout();
    }
}
