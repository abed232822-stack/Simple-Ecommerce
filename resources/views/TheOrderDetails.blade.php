<x-layout>
    <div class="flex justify-center">
            <div class="flex flex-col gap-y-6 justify-center ">
                <div class="w-7xl  shadow-[0_0_20px_rgba(0,0,0,0.1)]  p-5 flex justify-between px-10  ">
                    <p>Product</p>
                    <p>Price</p>
                    <p>quantity</p>
                    <p>subtotal</p>
                    <p>remove</p>
                </div>
                @php
                    $total=0;
                @endphp
                @foreach ($OrdersDetail as $order_detail)
                    @php
                        $product1=\App\Models\Products::find($order_detail->products_id);
                        $total+=($product1->price)*($order_detail->quantity)
                    @endphp
                    <x-cart-product :product="$product1" :quantity="$order_detail->quantity"  />  
                @endforeach
                <div class="flex w-7xl shadow-[0_0_20px_rgba(0,0,0,0.1)] p-5 justify-between text-center px-10">
                    <p>Total</p>
                    <p>${{ $total }}</p>
                </div>
            </div>
        </div>
    </x-layout>