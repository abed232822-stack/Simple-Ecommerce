<x-layout>
    <div class="flex flex-col">
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
                    $cart=session('cart',[]);
                @endphp
                @foreach ($cart as $id=>$item )
                    @php
                        $product1=\App\Models\Products::find($id);
                        $total+=($product1->price)*($item['quantity'])
                    @endphp

                    <x-cart-product :product="$product1" :quantity="$item['quantity']"  />  
                @endforeach
                <div class="flex w-7xl  shadow-[0_0_20px_rgba(0,0,0,0.1)]  p-5 justify-between text-center px-10  ">
                    <p>Total</p>
                    <p>${{ $total }}</p>
                </div>
                <div class="flex justify-between">
                    <x-href-button href="/">Return to Shop</x-href-button>
                    <div>
                        <form  class="flex gap-x-5 "action="{{ route('order.post') }}" method="Post">
                            @csrf
                            <x-session-input name="OrderName" placeHolder="Orders name" />
                            <x-submit-button>Order</x-submit-button>
                            <x-form-error name="OrderName" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="ml-30 mt-10">
            <div class="flex flex-col gap-y-5">
                    <p class="text-5xl font-bold">Orders</p>
                    <div class="w-7xl  shadow-[0_0_20px_rgba(0,0,0,0.1)]  p-5 flex gap-x-130 px-10 items-center max-w-6xl">
                        <p>total</p>
                        <p>Status</p>
                    </div>
                @foreach ($orders as $order)
                    <a href="{{ route('showDetails.order',[$order]) }}">
                        <x-cart-order :order="$order" />
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    
    </x-layout>