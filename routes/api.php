<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLocationController;
use App\Http\Controllers\UserStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ログインAPI
Route::post('login', [AuthController::class, 'login']);
// ログアウトAPI
Route::post('logout', [AuthController::class, 'logout']);

// ミドルウェア auth:sanctum を指定したグループ
Route::group(['middleware' => ['auth:sanctum']], function () {
    // ログイン情報取得API
    Route::get('me', [AuthController::class, 'me']);
    // 社員情報API
    Route::apiResource('Users', UserController::class, ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
    // エリアAPI
    Route::apiResource('Areas', AreaController::class, ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
    // 勤怠API
    Route::get('attendance', AttendanceController::class);
    // ユーザステータスAPI
    Route::get('user-status', UserStatusController::class);
    // 位置情報API
    Route::get('user-location', UserLocationController::class, ['only' => ['index', 'show', 'update']]);
});
