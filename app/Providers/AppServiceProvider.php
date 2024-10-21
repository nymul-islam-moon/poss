<?php

namespace App\Providers;

use App\Repositories\Interfaces\CustomerServiceInterface;
use App\Repositories\Interfaces\DepartmentServiceInterface;
use App\Repositories\Interfaces\JobServiceInterface;
use App\Repositories\Services\CustomerService;
use App\Repositories\Services\DepartmentService;
use App\Repositories\Services\JobService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerServiceInterface::class, CustomerService::class);
        $this->app->bind(DepartmentServiceInterface::class, DepartmentService::class);
        $this->app->bind(JobServiceInterface::class, JobService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
