<?php

namespace App\Providers;

use App\Http\Controllers\TaskController;
use App\Repositories\Task\TaskRepository;
use App\Repositories\Task\TaskRepositoryContract;
use App\Services\TaskService;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(TaskRepositoryContract::class, TaskRepository::class);

        $this->app->bind(TaskController::class, function () {
            return new TaskController(new TaskRepository());
        });

        $this->app->bind('task', TaskService::class);
    }
}
