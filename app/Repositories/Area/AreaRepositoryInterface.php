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
}
