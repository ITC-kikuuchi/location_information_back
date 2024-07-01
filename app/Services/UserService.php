<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\DataExistenceCheckTrait;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;
    use DataExistenceCheckTrait;

    /**
     * UserService コンストラクタ
     * UserRepositoryInterface の依存性を注入する
     *
     * @param UserRepositoryInterface $userRepositoryInterface
     */
    public function __construct(protected UserRepositoryInterface $userRepositoryInterface)
    {
    }

    /**
     * ユーザ一覧取得
     *
     * @return JsonResponse
     */
    public function getUsers(): JsonResponse
    {
        // 初期値設定
        $responseData = [];
        try {
            // ユーザ一覧取得
            $users = $this->userRepositoryInterface->getUsers();
            // レスポンスデータの作成
            foreach ($users as $user) {
                $responseData[User::USER_LIST][] = [
                    User::ID => $user[User::ID],
                    User::USER_NAME => $user[User::USER_NAME],
                    User::USER_NAME_KANA => $user[User::USER_NAME_KANA],
                    User::MAIL_ADDRESS => $user[User::MAIL_ADDRESS],
                    User::IS_ADMIN => (bool)$user[User::IS_ADMIN],
                ];
            }
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse($responseData);
    }

    /**
     * ユーザ登録
     *
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function createUser(CreateUserRequest $request): JsonResponse
    {
        try {
            // 登録データの作成
            $user = $this->createUserData($request);
            // データベーストランザクションの開始
            DB::transaction(function () use ($user) {
                // データ登録処理
                $this->userRepositoryInterface->createUser($user);
            });
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse();
    }

    /**
     * ユーザ詳細取得
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function getUserDetail(int $id): JsonResponse
    {
        // 初期値設定
        $responseData = [];
        try {
            // id に紐づくユーザの取得
            $userData = $this->userRepositoryInterface->getUser($id);
            // データ存在チェック
            $this->dataExistenceCheck($userData);
            // レスポンスデータの作成
            $responseData = [
                User::ID => $userData[User::ID],
                User::USER_NAME => $userData[User::USER_NAME],
                User::USER_NAME_KANA => $userData[User::USER_NAME_KANA],
                User::MAIL_ADDRESS => $userData[User::MAIL_ADDRESS],
                User::IS_ADMIN => (bool)$userData[User::IS_ADMIN],
                User::DEFAULT_AREA_ID => $userData[User::DEFAULT_AREA_ID],
            ];
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse($responseData);
    }

    /**
     * ユーザ更新
     *
     * @param UpdateUserRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function updateUser(UpdateUserRequest $request, int $id): JsonResponse
    {
        try {
            // id に紐づくユーザの取得
            $userData = $this->userRepositoryInterface->getUser($id);
            // データ存在チェック
            $this->dataExistenceCheck($userData);
            // 更新データの作成
            $user = $this->createUserData($request);
            // データベーストランザクションの開始
            DB::transaction(function () use ($id, $user) {
                // データ更新処理
                $this->userRepositoryInterface->updateUser($id, $user);
            });
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse();
    }


    /**
     * ユーザ削除
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function deleteUser(int $id): JsonResponse
    {
        try {
            // id に紐づくユーザのデータ存在チェック
            $this->dataExistenceCheck($this->userRepositoryInterface->getUser($id));
            // データベーストランザクションの開始
            DB::transaction(function () use ($id) {
                // データ削除処理
                $this->userRepositoryInterface->deleteUser($id);
            });
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // 200 レスポンス
        return $this->okResponse();
    }

    /**
     * ユーザ情報作成処理
     *
     * @param object $request
     * @return array
     */
    private function createUserData(object $request)
    {
        // ユーザ情報の作成
        $user = [
            User::USER_NAME => $request[User::USER_NAME],
            User::USER_NAME_KANA => $request[User::USER_NAME_KANA],
            User::MAIL_ADDRESS => $request[User::MAIL_ADDRESS],
            User::IS_ADMIN => $request[User::IS_ADMIN],
            User::DEFAULT_AREA_ID  => $request[User::DEFAULT_AREA_ID]
        ];
        if ($request[User::PASSWORD]) {
            // リクエスト値にパスワードが存在した場合
            $user[User::PASSWORD] = Hash::make($request[User::PASSWORD]);
        }
        return $user;
    }
}
