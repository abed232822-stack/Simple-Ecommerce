@props(['order'])
<div class="space-y-5">
    <x-big-heading>{{ $order->name }}</x-big-heading>
    
    <div class="w-7xl  shadow-[0_0_20px_rgba(0,0,0,0.1)]  p-5 flex justify-between px-10 items-center ">
                
            
                <p> {{ $order->total }}</p>
                <p>{{ $order->status }}</p>
                <form action="{{ route('order.delete',[$order]) }}" method="Post">
                    @csrf
                    @method('DELETE')
                    <button class="hover:bg-red-500 p-2 hover:rounded-lg hover:cursor-pointer hover:text-white">remove</button>
                </form>
            </div>
</div>