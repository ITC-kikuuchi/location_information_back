<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    // テーブ名
    const TABLE = 'm_attendance';
    public $table = self::TABLE;

    // カラム名
    const ID = 'id';
    const ATTENDANCE_STATUS = 'attendance_status';
    const CREATED_ID = 'created_id';
    const UPDATED_ID = 'updated_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        self::ID,
        self::ATTENDANCE_STATUS,
        self::CREATED_ID,
        self::UPDATED_ID,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    // レスポンスで使用する key
    const ATTENDANCE_LIST = 'attendance_list';
}
