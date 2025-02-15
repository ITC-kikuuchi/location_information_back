<?php

declare(strict_types=1);

namespace App\Traits;

use App\Exceptions\NotFoundException;

trait CheckDataExistenceTrait
{
    /**
     * データ存在チェック処理
     *
     * @param object|null $data
     */
    public function checkDataExistence(object|null $data): void
    {
        if (!$data) {
            // データが存在しなかった場合
            throw new NotFoundException();
        }
    }
}
