<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\SettingLocation;
use App\Http\Requests\UserLocation\UpdateUserLocationRequest;
use App\Models\Area;
use App\Models\Attendance;
use App\Models\User;
use App\Models\UserStatus;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\DataExistenceCheckTrait;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ExecutionAuthorityCheckTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserLocationService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;
    use DataExistenceCheckTrait;
    use ExecutionAuthorityCheckTrait;

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
            // ユーザ位置情報一覧取得
            $userLocations = $this->userRepositoryInterface->getUserLocations();
            // レスポンスデータの作成
            foreach ($userLocations as $userLocation) {
                $responseData[User::USER_LIST][] = [
                    User::ID => $userLocation[User::ID],
                    User::USER_NAME => $userLocation[User::USER_NAME],
                    User::USER_NAME_KANA => $userLocation[User::USER_NAME_KANA],
                    User::AREA_ID => $userLocation[User::AREA_ID],
                    Area::AREA_NAME => $userLocation[Area::AREA_NAME],
                    User::ATTENDANCE_ID => $userLocation[User::ATTENDANCE_ID],
                    Attendance::ATTENDANCE_STATUS => $userLocation[Attendance::ATTENDANCE_STATUS],
                    User::USER_STATUS_ID => $userLocation[User::USER_STATUS_ID],
                    UserStatus::USER_STATUS => $userLocation[UserStatus::USER_STATUS],
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
     * @param integer $id
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

    /**
     * ユーザ位置情報更新処理
     *
     * @param integer $id
     * @param UpdateUserLocationRequest $request
     * @return JsonResponse
     */
    public function updateUserLocation(int $id, UpdateUserLocationRequest $request): JsonResponse
    {
        try {
            // 実行権限チェック
            $this->IdCheck($id);
            // id に紐づくユーザの取得
            $user = $this->userRepositoryInterface->getUserDetail($id);
            // データ存在チェック
            $this->dataExistenceCheck($user);
            // 更新データの作成
            if ($request[User::ATTENDANCE_ID]) {
                // 勤怠ID が存在した場合
                $userLocation = [
                    User::ATTENDANCE_ID => $request[User::ATTENDANCE_ID],
                    User::AREA_ID => SettingLocation::getAreaId($request[User::ATTENDANCE_ID], $user[User::DEFAULT_AREA_ID]),
                    User::USER_STATUS_ID => SettingLocation::getUserStatusId($request[User::ATTENDANCE_ID])
                ];
            } else {
                // エリアID または ユーザステータスID が存在した場合
                $userLocation = [
                    User::AREA_ID => $request[User::AREA_ID] ?? $user[User::AREA_ID],
                    User::USER_STATUS_ID => $request[User::USER_STATUS_ID] ?? $user[User::USER_STATUS_ID],
                ];
            }
            // データベーストランザクションの開始
            DB::transaction(function () use ($id, $userLocation) {
                // データ更新処理
                $this->userRepositoryInterface->updateUser($id, $userLocation);
            });
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse();
    }
}
