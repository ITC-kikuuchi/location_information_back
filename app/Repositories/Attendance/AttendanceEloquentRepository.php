<?php

declare(strict_types=1);

namespace App\Repositories\Attendance;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * 勤怠状況一覧取得
     *
     * @return Collection
     */
    public function getAttendances(): Collection
    {
        return $this->attendance->get();
    }
}
