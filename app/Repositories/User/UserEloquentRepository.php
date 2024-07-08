<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\Area;
use App\Models\Attendance;
use App\Models\User;
use App\Models\UserStatus;

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

    /**
     * ユーザ一覧取得
     *
     * @return object|null
     */
    public function getUsers(): object|null
    {
        return $this->user->get();
    }

    /**
     * ユーザ登録
     *
     * @param array $user
     */
    public function createUser(array $user)
    {
        $this->user->create($user);
    }

    /**
     * ユーザ詳細取得
     *
     * @param integer $id
     * @return object|null
     */
    public function getUser(int $id): object|null
    {
        return $this->user->find($id);
    }

    /**
     * ユーザ更新
     *
     * @param integer $id
     * @param array $user
     */
    public function updateUser(int $id, array $user)
    {
        $this->user->where(User::ID, $id)->update($user);
    }

    /**
     * ユーザ削除
     *
     * @param integer $id
     */
    public function deleteUser(int $id)
    {
        $this->user->destroy($id);
    }

    /**
     * ユーザ位置情報一覧取得
     *
     * @return object|null
     */
    public function getUsersLocations(): object|null
    {
        return $this->user
            ->select(
                User::TABLE . '.*',
                Area::TABLE . '.' . Area::AREA_NAME,
                Attendance::TABLE . '.' . Attendance::ATTENDANCE_STATUS,
                UserStatus::TABLE . '.' . UserStatus::USER_STATUS
            )
            ->leftJoin(Area::TABLE, User::AREA_ID, '=', Area::TABLE . '.' . Area::ID)
            ->leftJoin(Attendance::TABLE, User::ATTENDANCE_ID, '=', Attendance::TABLE . '.' . Attendance::ID)
            ->leftJoin(UserStatus::TABLE, User::USER_STATUS_ID, '=', UserStatus::TABLE . '.' . UserStatus::ID)
            ->get();
    }

    /**
     * ユーザ位置情報詳細取得
     *
     * @param int $id
     * @return object|null
     */
    public function getDetailUserLocation(int $id): object|null
    {
        return $this->user->select(
            User::TABLE . '.' . User::ID,
            User::TABLE . '.' . User::USER_NAME,
            Area::TABLE . '.' . Area::AREA_NAME,
            Attendance::TABLE . '.' . Attendance::ATTENDANCE_STATUS,
            UserStatus::TABLE . '.' . UserStatus::USER_STATUS
        )
            ->leftJoin(Area::TABLE, User::AREA_ID, '=', Area::TABLE . '.' . Area::ID)
            ->leftJoin(Attendance::TABLE, User::ATTENDANCE_ID, '=', Attendance::TABLE . '.' . Attendance::ID)
            ->leftJoin(UserStatus::TABLE, User::USER_STATUS_ID, '=', UserStatus::TABLE . '.' . UserStatus::ID)
            ->find($id);
    }
}
