<?php

namespace App\Http\Controllers;

use App\Http\Requests\Area\CreateAreaRequest;
use App\Http\Requests\Area\UpdateAreaRequest;
use App\Services\AreaService;
use Illuminate\Http\JsonResponse;

class AreaController extends Controller
{
    /**
     * AreaController コンストラクタ
     * AreaService の依存性を注入する
     *
     * @param AreaService $areaService
     */
    public function __construct(protected AreaService $areaService)
    {
    }

    /**
     * エリア一覧取得API
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->areaService->getAreas();
    }

    /**
     * エリア登録API
     *
     * @param CreateAreaRequest $request
     * @return JsonResponse
     */
    public function store(CreateAreaRequest $request): JsonResponse
    {
        return $this->areaService->createArea($request);
    }

    /**
     * エリア詳細取得API
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->areaService->getDetailArea($id);
    }

    /**
     * エリア更新API
     *
     * @param UpdateAreaRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function update(UpdateAreaRequest $request, int $id): JsonResponse
    {
        return $this->areaService->updateArea($id, $request);
    }

    /**
     * エリア削除API
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->areaService->deleteArea($id);
    }
}
