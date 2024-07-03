<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Area;
use App\Repositories\Area\AreaRepositoryInterface;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class AreaService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;

    /**
     * AreaService コンストラクタ
     * AreaRepositoryInterface の依存性を注入する
     *
     * @param AreaRepositoryInterface $areaRepositoryInterface
     */
    public function __construct(protected AreaRepositoryInterface $areaRepositoryInterface)
    {
    }

    /**
     * エリア一覧取得
     *
     * @return JsonResponse
     */
    public function getArea(): JsonResponse
    {
        // 初期値設定
        $responseData = [];
        try {
            // エリア一覧取得
            $areas = $this->areaRepositoryInterface->getAreas();
            // レスポンスデータの作成
            foreach ($areas as $area) {
                $responseData[Area::AREA_LIST][] = [
                    Area::ID => $area[Area::ID],
                    Area::AREA_NAME => $area[Area::AREA_NAME],
                    Area::IS_DEFAULT_AREA => (bool)$area[Area::IS_DEFAULT_AREA]
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
