<?php

namespace App\Enums;

use App\Enums\Area;
use App\Enums\UserStatus;

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
            self::TWO->value => Area::HOME->value,
            self::THREE->value => Area::NONE->value,
            self::FOUR->value => Area::NONE->value,
            self::FIVE->value => Area::NONE->value,
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
            self::ONE->value => UserStatus::OWN_SEAT->value,
            self::TWO->value => UserStatus::OWN_SEAT->value,
            self::THREE->value => UserStatus::NONE->value,
            self::FOUR->value => UserStatus::OUTING->value,
            self::FIVE->value => UserStatus::NONE->value,
        };
    }
}
