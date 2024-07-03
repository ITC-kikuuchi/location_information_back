<?php

declare(strict_types=1);

namespace App\Repositories\Area;

use App\Models\Area;

class AreaEloquentRepository implements AreaRepositoryInterface
{
    /**
     * AreaEloquentRepository コンストラクタ
     * Area の依存性を注入する
     *
     * @param Area $area
     */
    public function __construct(protected Area $area)
    {
    }

    /**
     * エリア一覧取得
     *
     * @return object|null
     */
    public function getAreas(): object|null
    {
        return $this->area->get();
    }
}
