<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLocation\UpdateUserLocationRequest;
use App\Services\UserLocationService;
use Illuminate\Http\JsonResponse;

class UserLocationController extends Controller
{
    /**
     * UserLocationController コンストラクタ
     * UserLocationService の依存性を注入する
     *
     * @param UserLocationService $userLocationService
     */
    public function __construct(protected UserLocationService $userLocationService)
    {
    }

    /**
     * ユーザ位置情報一覧取得API
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->userLocationService->getUserLocations();
    }

    /**
     * ユーザ位置情報詳細取得API
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->userLocationService->getUserLocationDetail($id);
    }

    /**
     * ユーザ位置情報更新API
     *
     * @param UpdateUserLocationRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function update(UpdateUserLocationRequest $request, int $id): JsonResponse
    {
        return $this->userLocationService->updateUserLocation($id, $request);
    }
}
