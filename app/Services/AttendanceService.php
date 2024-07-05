<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Attendance;
use App\Repositories\Attendance\AttendanceRepositoryInterface;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class AttendanceService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;

    /**
     * AttendanceService コンストラクタ
     * AttendanceRepositoryInterface の依存性を注入する
     *
     * @param AttendanceRepositoryInterface $attendanceRepositoryInterface
     */
    public function __construct(protected AttendanceRepositoryInterface $attendanceRepositoryInterface)
    {
    }

    /**
     * 勤怠状況一覧取得
     *
     * @return JsonResponse
     */
    public function getAttendances(): JsonResponse
    {
        // 初期値設定
        $responseData = [];
        try {
            // 勤怠一覧取得
            $attendances = $this->attendanceRepositoryInterface->getAttendances();
            // レスポンスデータの作成
            foreach ($attendances as $attendance) {
                $responseData[Attendance::ATTENDANCE_LIST][] = [
                    Attendance::ID => $attendance[Attendance::ID],
                    Attendance::ATTENDANCE_STATUS => $attendance[Attendance::ATTENDANCE_STATUS]
                ];
            }
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse($responseData);
    }
}
