<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Area;
use App\Models\Attendance;
use App\Models\User;
use App\Models\UserStatus;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class UserLocationService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;
}
