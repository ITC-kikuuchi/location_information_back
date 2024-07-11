<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    // テーブ名
    const TABLE = 'm_user_status';
    public $table = self::TABLE;

    // カラム名
    const ID = 'id';
    const USER_STATUS = 'user_status';
    const CREATED_ID = 'created_id';
    const UPDATED_ID = 'updated_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        self::ID,
        self::USER_STATUS,
        self::CREATED_ID,
        self::UPDATED_ID,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    // レスポンスで使用する key
    const USER_STATUS_LIST = 'user_status_list';
    // 自席
    const OWN_SEAT = 1;
    // 離席
    const LEAVE_SEAT = 2;
    // 会議中
    const IN_A_MEETING = 3;
    // 外出中
    const OUTING = 4;
    // なし
    const NONE = 5;
}
