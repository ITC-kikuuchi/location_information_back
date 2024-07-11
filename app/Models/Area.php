<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    // テーブ名
    const TABLE = 'm_area';
    public $table = self::TABLE;

    // カラム名
    const ID = 'id';
    const AREA_NAME = 'area_name';
    const IS_DEFAULT_AREA = 'is_default_area';
    const CREATED_ID = 'created_id';
    const UPDATED_ID = 'updated_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        self::ID,
        self::AREA_NAME,
        self::IS_DEFAULT_AREA,
        self::CREATED_ID,
        self::UPDATED_ID,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    // レスポンスで使用する key
    const AREA_LIST = 'area_list';
    // 2F開発部屋
    const SECOND_FLOOR_DEVELOPMENT_ROOM = 1;
    // 2F会議室
    const SECOND_FLOOR_CONFERENCE_ROOM = 2;
    // 1F開発部屋
    const FIRST_FLOOR_DEVELOPMENT_ROOM = 3;
    // 1F会議室
    const FIRST_FLOOR_CONFERENCE_ROOM = 4;
    // 自宅
    const HOME = 5;
    // なし
    const NONE = 6;
}
