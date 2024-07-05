<?php

declare(strict_types=1);

namespace App\Repositories\Area;

interface AreaRepositoryInterface
{
    /**
     * エリア一覧取得
     *
     * @return object|null
     */
    public function getAreas(): object|null;

    /**
     * エリア登録
     *
     * @param array $area
     */
    public function createArea(array $area);

    /**
     * エリア詳細取得
     *
     * @param integer $id
     * @return object|null
     */
    public function getArea(int $id): object|null;

    /**
     * エリア更新
     *
     * @param int $id
     * @param array $area
     */
    public function updateArea(int $id, array $area);

    /**
     * エリア削除
     *
     * @param int $id
     */
    public function deleteArea(int $id);
}
