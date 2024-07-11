<?php

namespace App\Enums;

use App\Models\Area;
use App\Models\UserStatus;

enum SettingLocation: int
{
    case ONE = 1;
    case TWO = 2;
    case THREE = 3;
    case FOUR = 4;
    case FIVE = 5;

    /**
     * 勤怠IDに紐づくエリアIDの返却
     *
     * @param integer $attendance_id
     * @param integer $default_area_id
     * @return integer
     */
    public static function getAreaId(int $attendance_id, int $default_area_id): int
    {
        return match ($attendance_id) {
            self::ONE->value => $default_area_id,
            self::TWO->value => Area::HOME,
            self::THREE->value => Area::NONE,
            self::FOUR->value => Area::NONE,
            self::FIVE->value => Area::NONE,
        };
    }

    /**
     * 勤怠IDに紐づくステータスの返却
     *
     * @param integer $attendance_id
     * @return integer
     */
    public static function getUserStatusId(int $attendance_id): int
    {
        return match ($attendance_id) {
            self::ONE->value => UserStatus::OWN_SEAT,
            self::TWO->value => UserStatus::OWN_SEAT,
            self::THREE->value => UserStatus::NONE,
            self::FOUR->value => UserStatus::OUTING,
            self::FIVE->value => UserStatus::NONE,
        };
    }
}
