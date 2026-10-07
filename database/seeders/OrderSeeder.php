<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = User::where('email','customer@example.com')->firstOrFail();

        // Totals are filled in by OrderDetailSeeder once the items exist.
        foreach (['Order 1' => 'pending', 'Order 2' => 'accepted'] as $name => $status) {
            Order::firstOrCreate(
                ['user_id' => $customer->id, 'name' => $name],
                ['total' => 0, 'status' => $status]
            );
        }
    }
}
