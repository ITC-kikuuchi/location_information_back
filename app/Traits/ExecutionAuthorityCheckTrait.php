<?php

declare(strict_types=1);

namespace App\Traits;

use App\Exceptions\ForbiddenException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait ExecutionAuthorityCheckTrait
{
    /**
     * 管理者権限及びIDチェック
     *
     * @param int $userId
     */
    public function AdminAuthorityAndIdCheck(int $userId = null)
    {
        // 認証済みユーザの取得
        $user = Auth::user();
        if (!$user[User::IS_ADMIN]) {
            // 管理者権限が存在しない場合
            if (!$userId || $user[User::ID] != $userId) {
                // ユーザID が存在しない、またはログインユーザのID と一致しない場合
                throw new ForbiddenException();
            }
        }
    }
}
