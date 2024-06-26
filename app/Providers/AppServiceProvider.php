<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Area\AreaRepositoryInterface::class,
            \App\Repositories\Area\AreaEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Attendance\AttendanceRepositoryInterface::class,
            \App\Repositories\Attendance\AttendanceEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\UserStatus\UserStatusRepositoryInterface::class,
            \App\Repositories\UserStatus\UserStatusEloquentRepository::class
        );
    }
}
