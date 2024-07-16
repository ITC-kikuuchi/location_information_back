<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\CheckDataExistenceTrait;
use App\Traits\CheckExecutionAuthorityTrait;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use ResponseTrait;
    use ExceptionHandlerTrait;
    use CheckDataExistenceTrait;
    use CheckExecutionAuthorityTrait;

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
            // 実行権限チェック
            $this->checkExecutionAuthority();
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
            // 実行権限チェック
            $this->checkExecutionAuthority();
            // 登録データの作成
            $user = $this->formatUserData($request, true);
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
            // 実行権限チェック
            $this->checkExecutionAuthority($id);
            // id に紐づくユーザの取得
            $user = $this->userRepositoryInterface->getUserDetail($id);
            // データ存在チェック
            $this->checkDataExistence($user);
            // レスポンスデータの作成
            $responseData = [
                User::ID => $user[User::ID],
                User::USER_NAME => $user[User::USER_NAME],
                User::USER_NAME_KANA => $user[User::USER_NAME_KANA],
                User::MAIL_ADDRESS => $user[User::MAIL_ADDRESS],
                User::DEFAULT_AREA_ID => $user[User::DEFAULT_AREA_ID],
            ];
            if ($id != Auth::id()) {
                // 自分のデータではない場合
                $responseData[User::IS_ADMIN] = $user[User::IS_ADMIN];
            }
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
            // 実行権限チェック
            $this->checkExecutionAuthority($id);
            // id に紐づくユーザの取得
            $userData = $this->userRepositoryInterface->getUserDetail($id);
            // データ存在チェック
            $this->checkDataExistence($userData);
            // 更新データの作成
            $user = $this->formatUserData($request, false, $id);
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
            // 実行権限チェック
            $this->checkExecutionAuthority();
            // id に紐づくユーザのデータ存在チェック
            $this->checkDataExistence($this->userRepositoryInterface->getUserDetail($id));
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
     * @param boolean $isCreate
     * @param integer|null $id
     * @return array
     */
    private function formatUserData(object $request, bool $isCreate, int $id = null): array
    {
        // 認証ユーザの取得
        $loginUser = Auth::user();
        // ユーザ情報の作成
        $user = [
            User::USER_NAME => $request[User::USER_NAME],
            User::USER_NAME_KANA => $request[User::USER_NAME_KANA],
            User::MAIL_ADDRESS => $request[User::MAIL_ADDRESS],
            User::DEFAULT_AREA_ID  => $request[User::DEFAULT_AREA_ID],
            User::UPDATED_ID => $loginUser[User::ID]
        ];
        if ($request[User::PASSWORD]) {
            // リクエスト値にパスワードが存在した場合
            $user[User::PASSWORD] = Hash::make($request[User::PASSWORD]);
        }
        if ($isCreate) {
            // 登録処理の場合
            $user[User::IS_ADMIN] = $request[User::IS_ADMIN];
            $user[User::CREATED_ID] = $loginUser[User::ID];
        } else if ($loginUser[User::IS_ADMIN] & $id != $loginUser[User::ID]) {
            // 更新処理の場合、かつ管理者権限が存在し、自分のデータではない場合
            $user[User::IS_ADMIN] = $request[User::IS_ADMIN];
        }
        return $user;
    }
}
