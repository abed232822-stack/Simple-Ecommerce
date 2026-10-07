<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seller = User::where('email', 'seller@example.com')->firstOrFail();

        $image = 'https://placehold.co/300x300?text=Product';

        $products = [
            ['Smartphone X', 'Phones', 600, 'accepted'],
            ['Laptop Pro 15', 'Computers', 1200, 'accepted'],
            ['PS5 Console', 'Gaming', 500, 'accepted'],
            ['Mirrorless Camera', 'Cameras', 800, 'accepted'],
            ['Smart Watch', 'Watches', 150, 'accepted'],
            ['Wireless Headphones', 'Headphones', 90, 'pending'],
        ];

        foreach ($products as [$name, $category, $price, $status]) {
            $product = Products::updateOrCreate(
                ['name' => $name],
                [
                    'user_id' => $seller->id,
                    'image' => $image,
                    'quantity' => 20,
                    'price' => $price,
                    'details' => "A simple description for $name.",
                    'status' => $status,
                ]
            );

            $product->categories()->syncWithoutDetaching(Category::where('name', $category)->first());
        }
    }
}
