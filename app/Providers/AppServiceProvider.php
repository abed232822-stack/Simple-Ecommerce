<?php

namespace App\Providers;

use App\Policies\AdminPolicy;
use App\Policies\ProductsPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }
    
    /**
     * Bootstrap any application services.
    */
    public function boot(): void
    {
        Gate::define('AddProduct', [ProductsPolicy::class, 'AddProduct']);
        Gate::define('RemovingFromOrder', [ProductsPolicy::class, 'RemovingFromOrder']);
        Gate::define('IsAdmin', [AdminPolicy::class, 'IsAdmin']);
        Model::unguard();
    }
}
