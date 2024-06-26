<?php

namespace App\Http\Controllers;

use App\Services\AttendanceService;
use Illuminate\Http\Request;

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
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        //
    }
}
