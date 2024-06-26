<?php

declare(strict_types=1);

namespace App\Traits;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

trait ExceptionHandlerTrait
{
    use ResponseTrait;

    /**
     * 例外発生時の処理
     *
     * @param Exception $e
     * @return JsonResponse
     */
    private function exceptionHandler(Exception $e): JsonResponse
    {
        if ($e instanceof UnauthorizedException) {
            // ログにエラーメッセージを出力
            Log::error($e);
            // 401エラー（権限関連の例外）
            return $this->unauthorizedResponse();
        } elseif ($e instanceof NotFoundException) {
            // ログにエラーメッセージを出力
            Log::error($e);
            // 404エラー（データ参照失敗の例外）
            return $this->notFoundResponse();
        } else {
            // ログにエラーメッセージを出力
            Log::error($e);
            // 500エラー（その他の例外）
            return $this->internalServerErrorResponse(['errors' => $e->getMessage()]);
        }
    }
}
