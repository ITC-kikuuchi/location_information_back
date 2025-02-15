<?php

declare(strict_types=1);

namespace App\Repositories\Area;

use App\Models\Area;
use Illuminate\Database\Eloquent\Collection;

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
     * @return Collection
     */
    public function getAreas(): Collection
    {
        return $this->area->get();
    }

    /**
     * エリア登録
     *
     * @param array $area
     */
    public function createArea(array $area)
    {
        $this->area->create($area);
    }

    /**
     * エリア詳細取得
     *
     * @param integer $id
     * @return object|null
     */
    public function getAreaDetail(int $id): object|null
    {
        return $this->area->find($id);
    }

    /**
     * エリア更新
     *
     * @param int $id
     * @param array $area
     */
    public function updateArea(int $id, array $area)
    {
        $this->area->where(Area::ID, $id)->update($area);
    }

    /**
     * エリア削除
     *
     * @param int $id
     */
    public function deleteArea(int $id)
    {
        $this->area->destroy($id);
    }
}
