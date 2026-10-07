@props(['product'])
<div class="flex flex-col gap-y-1 w-full max-w-[250px]">
        <a href="{{ route('productDetail',$product) }}">
            <div class="w-full h-[200px] rounded-lg flex items-center justify-center shadow-[0_0_20px_rgba(0,0,0,0.1)] ">
                <img class="w-[100px] h-[100px]" src="{{ $product->image_url }}" alt="{{ $product->name }}">
            </div>
            <div>{{ $product->name }}</div>
            <div class="flex gap-x-5">
                <p class="text-[#db4444]">${{ $product->price }}</p>
                <p>{{ $product->quantity }}</p>
                </div>
        </a>
    </div>