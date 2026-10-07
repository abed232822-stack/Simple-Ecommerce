<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Admin', 'email' => 'admin@example.com', 'role' => 'admin'],
            ['name' => 'Seller', 'email' => 'seller@example.com', 'role' => 'seller'],
            ['name' => 'Customer', 'email' => 'customer@example.com', 'role' => 'customer', 'balance' => 5000],
        ];

        foreach ($users as $data) {
            $user = User::unguarded(fn () => User::updateOrCreate(
                ['email' => $data['email']],
                ['name' => $data['name'], 'password' => 'password', 'balance' => $data['balance'] ?? null],
            ));

            $user->syncRoles($data['role']);
        }
    }
}
