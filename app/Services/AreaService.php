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
}
