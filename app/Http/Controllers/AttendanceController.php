<?php

namespace App\Http\Controllers;

use App\Services\AttendanceService;
use Illuminate\Http\JsonResponse;

class AttendanceController extends Controller
{
    /**
     * AttendanceController コンストラクタ
     * AttendanceService の依存性を注入する
     *
     * @param AttendanceService $attendanceService
     */
    public function __construct(protected AttendanceService $attendanceService)
    {
    }

    /**
     * 勤怠状況一覧取得API
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return $this->attendanceService->getAttendances();
    }
}
