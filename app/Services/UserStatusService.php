<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\UserStatus;
use App\Repositories\UserStatus\UserStatusRepositoryInterface;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class UserStatusService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;

}
