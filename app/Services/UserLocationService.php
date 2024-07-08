<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Area;
use App\Models\Attendance;
use App\Models\User;
use App\Models\UserStatus;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\DataExistenceCheckTrait;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class UserLocationService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;
    use DataExistenceCheckTrait;

    /**
     * UserLocationService コンストラクタ
     * UserRepositoryInterface の依存性を注入する
     *
     * @param UserRepositoryInterface $userRepositoryInterface
     */
    public function __construct(protected UserRepositoryInterface $userRepositoryInterface)
    {
    }

    /**
     * ユーザ位置情報一覧取得
     *
     * @return JsonResponse
     */
    public function getUserLocations(): JsonResponse
    {
        // 初期値設定
        $responseData = [];
        try {
            // ユーザ一覧取得
            $users = $this->userRepositoryInterface->getUsersLocations();
            // レスポンスデータの作成
            foreach($users as $user) {
                $responseData[User::USER_LIST][] = [
                    User::ID => $user[User::ID],
                    User::USER_NAME => $user[User::USER_NAME],
                    User::USER_NAME_KANA=> $user[User::USER_NAME_KANA],
                    User::AREA_ID => $user[User::AREA_ID],
                    Area::AREA_NAME => $user[Area::AREA_NAME],
                    User::ATTENDANCE_ID => $user[User::ATTENDANCE_ID],
                    Attendance::ATTENDANCE_STATUS => $user[Attendance::ATTENDANCE_STATUS],
                    User::USER_STATUS_ID => $user[User::USER_STATUS_ID],
                    UserStatus::USER_STATUS => $user[UserStatus::USER_STATUS],
                ];
            }
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse($responseData);
    }

    /**
     * ユーザ位置情報詳細取得
     *
     * @return JsonResponse
     */
    public function getDetailUserLocation(int $id): JsonResponse
    {
        // 初期値設定
        $responseData = [];
        try {
            $userLocation = $this->userRepositoryInterface->getDetailUserLocation($id);
            // データ存在チェック
            $this->dataExistenceCheck($userLocation);
            // レスポンスデータの作成
            $responseData = [
                User::ID => $userLocation[User::ID],
                User::USER_NAME => $userLocation[User::USER_NAME],
                Area::AREA_NAME => $userLocation[Area::AREA_NAME],
                Attendance::ATTENDANCE_STATUS => $userLocation[Attendance::ATTENDANCE_STATUS],
                UserStatus::USER_STATUS => $userLocation[UserStatus::USER_STATUS],
            ];
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse($responseData);
    }
}
