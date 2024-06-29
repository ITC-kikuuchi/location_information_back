<?php

declare(strict_types=1);

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    /**
     * ユーザ一覧取得
     *
     * @return object|null
     */
    public function getUsers(): object|null;

    /**
     * ユーザ登録処理
     *
     * @param array $user
     */
    public function createUser(array $createUser);

    /**
     * ユーザ詳細取得
     *
     * @param integer $id
     * @return object|null
     */
    public function getUser(int $id): object|null;
}
