<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Area\AreaRepositoryInterface;

class AreaService
{
    /**
     * AreaService コンストラクタ
     * AreaRepositoryInterface の依存性を注入する
     *
     * @param AreaRepositoryInterface $areaRepositoryInterface
     */
    public function __construct(protected AreaRepositoryInterface $areaRepositoryInterface)
    {
    }
}
