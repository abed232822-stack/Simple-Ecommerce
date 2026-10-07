<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Models\Products;
use App\Models\User;
use App\Policies\ProductPolicy;
use App\Policies\ProductsPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Products::class => ProductsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate::define('AddProduct', [ProductsPolicy::class, 'AddProduct']);
        Gate::define('AddProduct', function (User $user) {
        return $user->role === 'seller';
    });
    }
}
