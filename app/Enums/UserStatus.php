<?php

namespace App\Enums;

enum UserStatus: int
{
    // 自席
    case OWN_SEAT = 1;
    // 離席
    case LEAVE_SEAT = 2;
    // 会議中
    case IN_A_MEETING = 3;
    // 外出中
    case OUTING = 4;
    // なし
    case NONE = 5;
}
