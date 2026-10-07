<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetail;
use App\Models\Products;
use App\Notifications\UserNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $name=$request['OrderName'];
        $carts=session('cart',[]);
        if (count($carts)==0)
        {
            return view('ErrorView',['nigga'=>'Theres nothing in the cart Nigga 404']);
        }
        $total=0;
        foreach($carts as $cart)
        {
            $product=Products::find($cart['id']);
            $product->user->notify(new UserNotification('your ' . $product->name . ' got ordered by ' . Auth::user()->name));
            $total+=$cart['quantity']*$product->price;
        }
        if ($total>Auth::user()->balance)
        {
            throw ValidationException::withMessages([
                'OrderName'=>'you dont have enough money nigga get a job'
            ]);
        }
        else 
        {
            $user=Auth::user();
            $user->balance-=$total;
            $user->save();
        }
        $order=Order::create([
            'user_id'=>Auth::user()->id,
            'name'=>$name,
            'total'=>$total,
            'status'=>'pending'
        ]);
        foreach($carts as $cart)
        {
            $product=Products::find($cart['id']);
            OrderDetail::create([
                'order_id'=>$order->id,
                'products_id'=>$product->id,
                'quantity'=>$cart['quantity'],
                'subTotal'=>$product->price*$cart['quantity']
            ]);
            //انشالله اتذكرن
            // $product->quantity-=$cart['quantity'];
            // $product->save();
        }
        session()->forget('cart');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return Auth::user()->orders;
    }
    public function showDetail(Order $order)
    {
        return view('TheOrderDetails',['OrdersDetail'=>$order->order_detail]);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect('/cart');
    }
}
