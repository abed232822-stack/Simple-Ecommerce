@props(['user'])
<div class="space-y-5 mt-5">
        @php
            if ($user->role=='customer')
            {
                $href=route('CustomerOrders',[$user]);
            }
            else 
            {
                $href=route('SellerProducts',[$user]);
            }
        @endphp
        <a href="{{ $href }}" class="hover:underline w-fit">
            <x-big-heading>{{ $user->name }}</x-big-heading>            
        </a>
        <div class="w-7xl shadow-[0_0_20px_rgba(0,0,0,0.1)] p-5 flex justify-between px-10 items-center mt-5">
                    <p> {{ $user->email }}</p>
                    @if ($user->role=='seller')
                        <p>How many products : {{ count($user->proudcts) }}</p>
                    @endif
                    @if ($user->role=='customer')
                        <form action="{{ route('UpdateBalance',$user) }}" method="Post">
                            @csrf
                            @method('PUT')
                            $
                            <x-session-input name="balance" :value="$user->balance"/>
                            <button class="bg-green-500  p-2 rounded-lg hover:cursor-pointer text-white ml-3">update</button>
                        </form>      
                    @endif
                </div>
</div>