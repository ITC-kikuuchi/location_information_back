<?php

namespace App\Http\Controllers;

use App\Services\UserStatusService;
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
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        //
    }
}
