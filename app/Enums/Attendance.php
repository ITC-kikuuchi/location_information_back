<?php

namespace App\Enums;

enum Attendance: int
{
    // 出社
    case GOING_TO_WORK = 1;
    // リモート
    case REMOTE = 2;
    // 退勤
    case CLOCKING_OUT = 3;
    // 出張
    case BUSINESS_TRIP = 4;
    // 休暇
    case VACATION = 5;
    // なし
    case NONE = 6;
}
