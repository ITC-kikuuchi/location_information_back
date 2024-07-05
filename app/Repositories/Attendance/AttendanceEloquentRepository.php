<?php

declare(strict_types=1);

namespace App\Repositories\Attendance;

use App\Models\Attendance;

class AttendanceEloquentRepository implements AttendanceRepositoryInterface
{
    /**
     * AttendanceEloquentRepository コンストラクタ
     * Attendance の依存性を注入する
     *
     * @param Attendance $attendance
     */
    public function __construct(protected Attendance $attendance)
    {
    }
}
