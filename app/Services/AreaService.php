<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\Area\CreateAreaRequest;
use App\Http\Requests\Area\UpdateAreaRequest;
use App\Models\Area;
use App\Repositories\Area\AreaRepositoryInterface;
use App\Traits\DataExistenceCheckTrait;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ExecutionAuthorityCheckTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AreaService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;
    use ExecutionAuthorityCheckTrait;
    use DataExistenceCheckTrait;

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
    public function getAreas(): JsonResponse
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

    /**
     * エリア登録
     *
     * @param CreateAreaRequest $request
     * @return JsonResponse
     */
    public function createArea(CreateAreaRequest $request): JsonResponse
    {
        try {
            // 実行権限チェック
            $this->ExecutionAuthorityCheck();
            // エリア情報の作成
            $area = $this->createAreaData($request, true);
            // データベーストランザクションの開始
            DB::transaction(function () use ($area) {
                // データ登録処理
                $this->areaRepositoryInterface->createArea($area);
            });
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse();
    }


    /**
     * エリア詳細取得
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function getDetailArea(int $id): JsonResponse
    {
        $responseData = [];
        try {
            // 実行権限チェック
            $this->ExecutionAuthorityCheck();
            // エリア詳細取得
            $area = $this->areaRepositoryInterface->getArea($id);
            // データ存在チェック
            $this->dataExistenceCheck($area);
            // レスポンスデータの作成
            $responseData = [
                Area::ID => $area[Area::ID],
                Area::AREA_NAME => $area[Area::AREA_NAME],
                Area::IS_DEFAULT_AREA => $area[Area::IS_DEFAULT_AREA],
            ];
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse($responseData);
    }

    /**
     * エリア更新
     *
     * @param integer $id
     * @param UpdateAreaRequest $request
     * @return JsonResponse
     */
    public function updateArea(int $id, UpdateAreaRequest $request): JsonResponse
    {
        try {
            // 実行権限チェック
            $this->ExecutionAuthorityCheck();
            // エリア情報の作成
            $area = $this->createAreaData($request, true);
            // データベーストランザクションの開始
            DB::transaction(function () use ($id, $area) {
                // データ更新処理
                $this->areaRepositoryInterface->updateArea($id, $area);
            });
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse();
    }

    /**
     * エリア削除
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function deleteArea(int $id): JsonResponse
    {
        try {
            // 実行権限チェック
            $this->ExecutionAuthorityCheck();
            // データ存在チェック
            $this->dataExistenceCheck($this->areaRepositoryInterface->getArea($id));
            // データベーストランザクションの開始
            DB::transaction(function () use ($id) {
                // データ削除処理
                $this->areaRepositoryInterface->deleteArea($id);
            });
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse();
    }

    /**
     *
     * エリア情報作成処理
     *
     * @param object $request
     * @param boolean|null $is_create
     * @return array $area
     */
    function createAreaData(object $request, bool|null $is_create = false): array
    {
        // 認証済みユーザの ID の取得
        $loginUserId = Auth::id();
        // エリア情報の作成
        $area = [
            Area::AREA_NAME => $request[Area::AREA_NAME],
            Area::IS_DEFAULT_AREA => (bool)$request[Area::IS_DEFAULT_AREA],
            Area::UPDATED_ID => $loginUserId,
        ];
        if ($is_create) {
            // エリア登録処理の場合
            $area[Area::CREATED_ID] = $loginUserId;
        }
        return $area;
    }
}
