<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\UserStatus;
use App\Repositories\UserStatus\UserStatusRepositoryInterface;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class UserStatusService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;

    /**
     * UserStatusService コンストラクタ
     * UserStatusRepositoryInterface の依存性を注入する
     *
     * @param UserStatusRepositoryInterface $userStatusRepositoryInterface
     */
    public function __construct(protected UserStatusRepositoryInterface $userStatusRepositoryInterface)
    {
    }

    /**
     * ユーザステータス一覧取得
     *
     * @return JsonResponse
     */
    public function getUserStatuses(): JsonResponse
    {
        // 初期値設定
        $responseData = [];
        try {
            // ユーザステータス一覧取得
            $userStatuses = $this->userStatusRepositoryInterface->getUserStatuses();
            // レスポンスデータの作成
            foreach ($userStatuses as $userStatus) {
                $responseData[UserStatus::USER_STATUS_LIST][] = [
                    UserStatus::ID => $userStatus[UserStatus::ID],
                    UserStatus::USER_STATUS => $userStatus[UserStatus::USER_STATUS]
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
