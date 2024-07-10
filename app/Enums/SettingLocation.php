<?php

namespace App\Enums;

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
            self::ONE->value => $default_area_id, // デフォルトエリア
            self::TWO->value => 5, // 自宅
            self::THREE->value => 6, // なし
            self::FOUR->value => 6, // なし
            self::FIVE->value => 6, // なし
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
            self::ONE->value => 1, // 自席
            self::TWO->value => 1, // 自席
            self::THREE->value => 5, // なし
            self::FOUR->value => 4, // 外出中
            self::FIVE->value => 5, // なし
        };
    }
}
