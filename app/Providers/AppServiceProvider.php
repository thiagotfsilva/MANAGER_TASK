<?php

namespace App\Providers;

use App\Domain\Task\Repository\TaskRepositoryInterface;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Infrastructure\Task\TaskRepository;
use App\Infrastructure\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
