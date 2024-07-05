<?php

declare(strict_types=1);

namespace App\Repositories\UserStatus;

use App\Models\UserStatus;

class UserStatusEloquentRepository implements UserStatusRepositoryInterface
{
    /**
     * UserStatusEloquentRepository コンストラクタ
     * UserStatus の依存性を注入する
     *
     * @param UserStatus $userStatus
     */
    public function __construct(protected UserStatus $userStatus)
    {
    }

    /**
     * ユーザステータス一覧取得
     *
     * @return object|null
     */
    public function getUserStatuses(): object|null
    {
        return $this->userStatus->get();
    }
}
