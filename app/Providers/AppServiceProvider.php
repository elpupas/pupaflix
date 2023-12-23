<?php

namespace App\Providers;

use App\Contracts\UserRepositoryInterface;
use App\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

     public function register():void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Cashier::calculateTaxes();
    }
}
