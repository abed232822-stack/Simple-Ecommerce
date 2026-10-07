<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function suggestions(Request $request) {
    $query = $request->input('query');
    $products = Products::where('name', 'LIKE', "%{$query}%")
                        ->take(5)
                        ->get();
    $data = $products->map(function($product) {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image_url' => $product->image_url, 
        ];
    });

    return response()->json($data);
}
}
