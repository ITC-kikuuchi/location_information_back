<?php

declare(strict_types=1);

namespace App\Repositories\Attendance;

use Illuminate\Database\Eloquent\Collection;

interface AttendanceRepositoryInterface
{
    /**
     * 勤怠状況一覧取得
     *
     * @return Collection
     */
    public function getAttendances(): Collection;
}
