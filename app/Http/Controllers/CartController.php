<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    public function index()
    {
        return view('cart',['orders'=> Auth::user()->orders]);
    }
    public function destroy($id)
    {
        $cart=session('cart',[]);
        if (isset($cart[$id]))
        {
            unset($cart[$id]);
        }
        session()->put('cart',$cart);
        return redirect('/cart');
    }
    public function AddToCart(Request $request,$id)
    {
        $quantity=$request->quantity;
        if (Products::find($id)->quantity<$quantity)
        {
            throw ValidationException::withMessages(
                [
                    'quantity'=>'there is not enough'
                ]
                );
        }        
        $cart = session('cart',[]);
        if (isset($cart[$id]))
        {
            if ($cart[$id]['quantity']+$quantity>Products::find($id)->quantity)
            {
                throw ValidationException::withMessages([
                    'quantity'=>'you already have alot in your cart'
                ]);
            }
            $cart[$id]['quantity']+=$quantity;
        }
        else 
        {
            $cart[$id]=[
                'id'=>$id,
                'quantity'=>$quantity
            ];
        }
        session()->put('cart',$cart);
        return back();
    }
}
