<?php

declare(strict_types=1);

namespace App\Repositories\UserStatus;

use Illuminate\Database\Eloquent\Collection;

interface UserStatusRepositoryInterface
{
    /**
     * ユーザステータス一覧取得
     *
     * @return object|null
     */
    public function getUserStatuses(): object|null;
}
