<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Products;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'Order 1' => ['Smartphone X' => 1, 'Smart Watch' => 2],
            'Order 2' => ['PS5 Console' => 1],
        ];

        foreach ($items as $orderName => $lines) {
            $order = Order::where('name', $orderName)->firstOrFail();

            foreach ($lines as $productName => $quantity) {
                $product = Products::where('name', $productName)->firstOrFail();

                OrderDetail::firstOrCreate(
                    ['order_id' => $order->id, 'products_id' => $product->id],
                    ['quantity' => $quantity, 'subTotal' => $product->price * $quantity]
                );
            }

            $order->update(['total' => $order->order_detail()->sum('subTotal')]);
        }
    }
}
