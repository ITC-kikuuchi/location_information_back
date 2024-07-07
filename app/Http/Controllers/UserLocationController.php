<?php

namespace App\Http\Controllers;

use App\Services\UserLocationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
