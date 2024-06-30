<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * UserController コンストラクタ
     * UserService の依存性を注入する
     *
     * @param UserService $userService
     */
    public function __construct(protected UserService $userService)
    {
    }

    /**
     * ユーザ一覧取得API
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->userService->getUsers();
    }

    /**
     * ユーザ登録API
     *
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function store(CreateUserRequest $request): JsonResponse
    {
        return $this->userService->createUser($request);
    }

    /**
     * ユーザ詳細取得API
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->userService->getUserDetail($id);
    }

    /**
     * ユーザ更新API
     *
     * @param UpdateUserRequest $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, string $id): JsonResponse
    {
        return $this->userService->updateUser($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
