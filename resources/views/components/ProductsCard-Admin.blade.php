@props(['product'])
<div class="space-y-5">
    <x-big-heading>{{ $product->name }}</x-big-heading>
    <div class="w-7xl  shadow-[0_0_20px_rgba(0,0,0,0.1)]  p-5 flex justify-between px-10 items-center  ">
                
            <div class="flex flex-col items-center gap-y-5">
            <img src="{{ $product->image_url }}" class="h-12 w-15" alt="{{ $product->name }}">
            </div>
                <p> ${{ $product->price }}</p>
                <p> {{ $product->quantity }}</p>
                <p>{{ $product->status }}</p>
                
                <form action="{{ route('ProductDelete',$product) }}" method="Post">
                    @csrf
                    @method('DELETE')
                    <button class="hover:bg-red-500 p-2 hover:rounded-lg hover:cursor-pointer hover:text-white">remove</button>
                </form> 
                <form action="{{ route('AcceptingProduct',[$product]) }}" method="Post">
                    @csrf
                    @method('Put')
                    <input type="text" name="status" value="accepted" class="hidden">
                    <button class="hover:bg-green-500 p-2 hover:rounded-lg hover:cursor-pointer hover:text-white">accept</button>
                </form>
                    
                
            </div>
</div>