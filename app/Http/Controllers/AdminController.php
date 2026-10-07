<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function GetCustomers()
    {
        return view('Admin.dashboard',['sellers'=>User::role('seller')->get()]);
    }
    public function GetSellers()
    {
        return view('Admin.dashboard',['customers'=>User::role('customer')->get()]);
    }
    public function CustomerOrdersShow(User $user)
    {
        return view('Admin.CustomerOrders',['orders'=>$user->orders,'user'=>$user]);
    }
    public function SellerProductsShow(User $user)
    {
        return view('Admin.SellerProducts',['products'=>$user->proudcts,'user'=>$user]);
    }
    public function UpdateBalance(Request $request,User $user)
    {
        $request->validate([
            'balance'=>['required','numeric']
        ]);
        $user->balance=$request['balance'];
        $user->save();
        $user->notify(new UserNotification('your balance got updated, new balance : ' . $user->balance));
        return back();
    }
    public function AcceptingRejectingOrder(Request $request,Order $order)
    {
        $request->validate([
            'status'=>['required']
        ]);
        if ($request['status']=='rejected'&&$order->status=='pending')
        {
            $user=$order->user;
            $user->balance+=$order['total'];
            $user->save();
        }
        $order->status=$request->status;
        $order->save();
        $user=$order->user;
        $user->notify(new UserNotification('your order ' . $order->name . ' got ' . $order->status));
        return back();
    }
    public function AcceptingPorductPublish(Products $product)
    {
        $product->status='accepted';
        $product->save();
        $product->user->notify(new UserNotification('you new product ' . $product->name . ' got published'));
        return back();
    }
    public function RegectingPorductPublish(Products $product)
    {
        $product->status='rejected';
        $product->user->notify(new UserNotification('you new product ' . $product->name . ' got rejected'));

        return back();
    }
}
