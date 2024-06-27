<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class UserService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;
}
