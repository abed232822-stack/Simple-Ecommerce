<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
class Spatie_roles_permissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // تنظيف الكاش
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [

            // Products
            'view products',
            'view product details',
            'create product',
            'edit product',
            'update product',
            'delete product',
            'accept product',
            'reject product',

            // Categories
            'view categories',
            'view category products',

            // Cart
            'add to cart',
            'view cart',
            'remove from cart',

            // Orders
            'create order',
            'create order details',
            'view own orders',
            'view order details',
            'delete own order',
            'accept order',
            'reject order',
            'delete order',

            // Users Management
            'view customers',
            'view sellers',
            'update user balance',
            'view customer orders',
            'view seller products',

            // Seller Dashboard
            'access seller dashboard',

            // Notifications
            'mark notifications as read',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $seller = Role::firstOrCreate(['name' => 'seller']);
        $customer = Role::firstOrCreate(['name' => 'customer']);

        /*
        |--------------------------------------------------------------------------
        | Assign Permissions To Roles
        |--------------------------------------------------------------------------
        */

        // Admin يأخذ كل شيء
        $admin->givePermissionTo(Permission::all());

        // Seller Permissions
        $seller->givePermissionTo([
            'view products',
            'view product details',
            'create product',
            'edit product',
            'update product',
            'delete product',
            'access seller dashboard',
            'view seller products',
        ]);

        // Customer Permissions
        $customer->givePermissionTo([
            'view products',
            'view product details',
            'view categories',
            'view category products',
            'add to cart',
            'view cart',
            'remove from cart',
            'create order',
            'create order details',
            'view own orders',
            'view order details',
            'delete own order',
            'mark notifications as read',
        ]);
    }
}
