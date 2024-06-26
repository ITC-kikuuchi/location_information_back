<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;

class UserEloquentRepository implements UserRepositoryInterface
{
    /**
     * UserEloquentRepository コンストラクタ
     * User の依存性を注入する
     *
     * @param User $user
     */
    public function __construct(protected User $user)
    {
    }
}
