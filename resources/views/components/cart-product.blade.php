@props(['product','quantity'])
<div class="space-y-5">
    <x-big-heading>{{ $product->name }}</x-big-heading>
    <div class="w-7xl  shadow-[0_0_20px_rgba(0,0,0,0.1)]  p-5 flex justify-between px-10 items-center  ">
                
            <div class="flex flex-col items-center gap-y-5">
            <img src="{{ $product->image_url }}" class="h-12 w-15" alt="{{ $product->name }}">
            </div>
                <p> ${{ $product->price }}</p>
                <p> {{ $quantity }}</p>
                @php
                    $subtotal=($product->price)*($quantity);
                @endphp
                <p>${{ $subtotal }}</p> 
               
                <form action="{{ route('cart.delete',[$product->id]) }}" method="Post">
                    @csrf
                    @method('DELETE')
                    <button class="hover:bg-red-500 p-2 hover:rounded-lg hover:cursor-pointer hover:text-white">remove</button>
                </form>
                    
                
            </div>
</div>