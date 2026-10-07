<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductsRequest;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function create()
    {
        $user=Auth::user();
        return view('Seller.Seller-dashboard',['products'=>$user->proudcts]);
    }
    public function edit(Products $product)
    {
        return view('Seller.Product-edit',['product'=>$product]);
    }
    public function update(UpdateProductsRequest $request,Products $product)
    {
        $NewProduct=$request->validated();
        if ($request->hasFile('image'))
        {
            $NewProduct['image']=$request->file('image')->store('images','public');
        }
        else 
        {
            unset($NewProduct['image']);
        }
        $product->update($NewProduct);
        return redirect(route('SellerDashboard'));
    }
}
