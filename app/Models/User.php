<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // テーブ名
    const TABLE = 'm_users';
    public $table = self::TABLE;

    // カラム名
    const ID = 'id';
    const MAIL_ADDRESS = 'mail_address';
    const PASSWORD = 'password';
    const USER_NAME = 'user_name';
    const USER_NAME_KANA = 'user_name_kana';
    const DEFAULT_AREA_ID = 'default_area_id';
    const IS_ADMIN = 'is_admin';
    const AREA_ID = 'area_id';
    const ATTENDANCE_ID = 'attendance_id';
    const USER_STATUS_ID = 'user_status_id';
    const CREATED_ID = 'created_id';
    const UPDATED_ID = 'updated_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        self::ID,
        self::MAIL_ADDRESS,
        self::PASSWORD,
        self::USER_NAME,
        self::USER_NAME_KANA,
        self::DEFAULT_AREA_ID,
        self::IS_ADMIN,
        self::AREA_ID,
        self::ATTENDANCE_ID,
        self::USER_STATUS_ID,
        self::CREATED_ID,
        self::UPDATED_ID,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];
}
