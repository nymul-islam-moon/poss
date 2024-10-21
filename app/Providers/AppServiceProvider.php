<?php

namespace App\Providers;

use App\Repositories\Interfaces\CustomerServiceInterface;
use App\Repositories\Interfaces\DepartmentServiceInterface;
use App\Repositories\Services\CustomerService;
use App\Repositories\Services\DepartmentService;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
