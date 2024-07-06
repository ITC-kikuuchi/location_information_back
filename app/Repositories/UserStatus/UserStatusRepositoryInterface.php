<?php

declare(strict_types=1);

namespace App\Repositories\UserStatus;

interface UserStatusRepositoryInterface
{
    /**
     * ユーザステータス一覧取得
     *
     * @return object|null
     */
    public function getUserStatuses(): object|null;
}
