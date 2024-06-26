<?php

namespace App\Http\Controllers;

use App\Services\UserLocationService;
use Illuminate\Http\Request;

class UserLocationController extends Controller
{
    /**
     * UserLocationController コンストラクタ
     * UserLocationService の依存性を注入する
     *
     * @param UserLocationService $userLocationService
     */
    public function __construct(protected UserLocationService $userLocationService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
