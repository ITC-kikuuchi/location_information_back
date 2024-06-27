<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;

    /**
     * UserService コンストラクタ
     * UserRepositoryInterface の依存性を注入する
     *
     * @param UserRepositoryInterface $userRepositoryInterface
     */
    public function __construct(protected UserRepositoryInterface $userRepositoryInterface)
    {
    }

    /**
     * ユーザ一覧取得
     *
     * @return JsonResponse
     */
    public function getUsers(): JsonResponse
    {
        $responseData = [];
        try {
            // ユーザ一覧取得
            $users = $this->userRepositoryInterface->getUsers();
            // レスポンスデータの作成
            foreach ($users as $user) {
                $responseData[User::USER_LIST][] = [
                    User::ID => $user[User::ID],
                    User::USER_NAME => $user[User::USER_NAME],
                    User::USER_NAME_KANA => $user[User::USER_NAME_KANA],
                    User::MAIL_ADDRESS => $user[User::MAIL_ADDRESS],
                    User::IS_ADMIN => (bool)$user[User::IS_ADMIN],
                ];
            }
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse($responseData);
    }
}
