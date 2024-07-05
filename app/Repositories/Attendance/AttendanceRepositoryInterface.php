<?php

declare(strict_types=1);

namespace App\Repositories\Attendance;

interface AttendanceRepositoryInterface
{
    /**
     * 勤怠状況一覧取得
     *
     * @return object|null
     */
    public function getAttendances(): object|null;
}
