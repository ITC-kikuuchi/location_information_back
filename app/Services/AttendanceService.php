<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Attendance;
use App\Repositories\Attendance\AttendanceRepositoryInterface;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class AttendanceService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;

}
