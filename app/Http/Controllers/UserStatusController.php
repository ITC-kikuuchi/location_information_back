<?php

namespace App\Http\Controllers;

use App\Services\UserStatusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    /**
     * UserStatusController コンストラクタ
     * UserStatusService の依存性を注入する
     *
     * @param UserStatusService $userStatusService
     */
    public function __construct(protected UserStatusService $userStatusService)
    {
    }

    /**
     * ユーザステータス一覧取得API
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return $this->userStatusService->getUserStatuses();
    }
}
