<?php

declare(strict_types=1);

namespace App\Repositories\User;

use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * ユーザ一覧取得
     *
     * @return Collection
     */
    public function getUsers(): Collection;

    /**
     * ユーザ登録処理
     *
     * @param array $user
     */
    public function createUser(array $user);

    /**
     * ユーザ詳細取得
     *
     * @param integer $id
     * @return object|null
     */
    public function getUserDetail(int $id): object|null;

    /**
     * ユーザ更新
     *
     * @param integer $id
     * @param array $user
     */
    public function updateUser(int $id, array $user);

    /**
     * ユーザ削除
     *
     * @param integer $id
     */
    public function deleteUser(int $id);

    /**
     * ユーザ位置情報一覧取得
     *
     * @return Collection
     */
    public function getUserLocations(): Collection;

    /**
     * ユーザ位置情報詳細取得
     *
     * @param int $id
     * @return object|null
     */
    public function getUserLocationDetail(int $id): object|null;
}
