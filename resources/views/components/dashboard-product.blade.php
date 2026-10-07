@props(['product','quantity'])
<div class="space-y-5">
    <x-big-heading>{{ $product->name }}</x-big-heading>
    <div class="w-7xl  shadow-[0_0_20px_rgba(0,0,0,0.1)]  p-5 flex justify-between px-10 items-center  ">
                
            <div class="flex flex-col items-center gap-y-5">
            <a href="{{ route('productDetail',$product) }}"><img src="{{ $product->image_url }}" class="h-12 w-15" alt="{{ $product->name }}"></a>
            </div>
                <p> ${{ $product->price }}</p>
                <p> {{ $quantity }}</p>
                <form action="{{ route('ProductDelete',$product) }}" method="Post">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 p-2  rounded-lg    hover:cursor-pointer text-white ">remove</button>
                </form>
                <a href="{{ route('SellerDashboard.edit',[$product]) }}" class="bg-green-600 p-2  rounded-lg    hover:cursor-pointer text-white ">update</a>
            </div>
</div>