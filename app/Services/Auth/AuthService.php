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
            User::IS_ADMIN => $loginUser[User::IS_ADMIN],
        ];
    }
}
