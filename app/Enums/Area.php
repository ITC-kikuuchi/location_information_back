<?php

namespace App\Enums;

enum Area: int
{
    // 2F開発部屋
    case SECOND_FLOOR_DEVELOPMENT_ROOM = 1;
    // 2F会議室
    case SECOND_FLOOR_CONFERENCE_ROOM = 2;
    // 1F開発部屋
    case FIRST_FLOOR_DEVELOPMENT_ROOM = 3;
    // 1F会議室
    case FIRST_FLOOR_CONFERENCE_ROOM = 4;
    // 自宅
    case HOME = 5;
    // なし
    case NONE = 6;
}
