<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Exceptions\UnauthorizedException;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;

    /**
     * AuthService コンストラクタ
     * UserRepositoryInterface の依存性を注入する
     *
     * @param UserRepositoryInterface $userRepositoryInterface
     */
    public function __construct(protected UserRepositoryInterface $userRepositoryInterface)
    {
    }

    /**
     * ログイン処理
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        // 初期値設定
        $responseData = [];
        try {
            if (Auth::attempt($request->only([User::MAIL_ADDRESS, User::PASSWORD]))) {
                // ユーザ認証に成功した場合
                $request->session()->regenerate();
                // レスポンスデータの作成
                $responseData = $this->userResponse(Auth::user());
            } else {
                // ユーザ認証に失敗した場合
                throw new UnauthorizedException();
            }
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse($responseData);
    }

    /**
     * ログイン情報取得
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        // 初期値設定
        $responseData = [];
        try {
            // 認証ユーザ情報の取得
            $loginUser = Auth::user();
            if (!$loginUser) {
                // ID に紐づくユーザ情報が存在しない場合
                throw new UnauthorizedException();
            }
            // レスポンスデータの作成
            $responseData = $this->userResponse($loginUser);
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse($responseData);
    }

    /**
     * ログアウト処理
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            // ログアウト処理
            Auth::logout();
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse();
    }

    /**
     * ユーザに関するレスポンスの作成
     *
     * @param object $loginUser
     * @return array
     */
    private function userResponse(object $loginUser): array
    {
        return [
            User::ID => $loginUser[User::ID],
            User::USER_NAME => $loginUser[User::USER_NAME],
            User::IS_ADMIN => (bool)$loginUser[User::IS_ADMIN],
        ];
    }
}
