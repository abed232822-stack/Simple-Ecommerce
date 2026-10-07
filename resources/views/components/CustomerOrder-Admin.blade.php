@props(['order'])
<div class="space-y-5">
    <x-big-heading>{{ $order->name }}</x-big-heading>
    <div>
        <a class="w-7xl  shadow-[0_0_20px_rgba(0,0,0,0.1)]  p-5 flex justify-between px-10 items-center" href="{{ route('showDetails.order',$order) }}">

            <p> {{ $order->total }}</p>
            <p>{{ $order->status }}</p>
            <form action="{{ route('AcceptingRejectingOrder',[$order]) }}" method="Post">
                @csrf
                @method('Put')
                <input type="text" name="status" value="rejected" class="hidden">
                <button class="hover:bg-red-500 p-2 hover:rounded-lg hover:cursor-pointer hover:text-white">reject</button>
            </form>
            <form action="{{ route('AcceptingRejectingOrder',[$order]) }}" method="Post">
                @csrf
                @method('Put')
                <input type="text" name="status" value="accepted" class="hidden">
                <button class="hover:bg-green-500 p-2 hover:rounded-lg hover:cursor-pointer hover:text-white">accept</button>
            </form>
        </a>
    </div>
</div>