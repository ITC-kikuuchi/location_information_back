<?php

namespace App\Http\Controllers;

use App\Http\Requests\Area\CreateAreaRequest;
use App\Services\AreaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
