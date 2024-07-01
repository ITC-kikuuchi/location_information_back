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
}
