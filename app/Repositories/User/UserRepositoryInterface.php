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
    public function createUser(array $user);

    /**
     * ユーザ詳細取得
     *
     * @param integer $id
     * @return object|null
     */
    public function getUser(int $id): object|null;

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
     * @return object|null
     */
    public function getUsersLocations(): object|null;

    /**
     * ユーザ位置情報詳細取得
     *
     * @param int $id
     * @return object|null
     */
    public function getDetailUserLocation(int $id): object|null;
}
