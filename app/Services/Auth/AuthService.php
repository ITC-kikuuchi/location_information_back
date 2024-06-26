<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Exceptions\UnauthorizedException;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;

}
