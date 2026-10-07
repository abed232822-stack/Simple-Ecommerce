<x-layout>
    <div class="w-full flex justify-center">
        <div class="text-2xl space-x-5">
            <x-nav-link  href="{{ route('GetSellers') }}">Customers</x-nav-link>
            <x-nav-link href="{{ route('GetCustomers') }}">Sellers</x-nav-link>
        </div>
    </div>
    <div class="flex justify-center mb-5">
        @if (isset($sellers))
            @foreach ($sellers as $seller)
                <x-user-card :user="$seller" />
            @endforeach
        @endif
        @if (isset($customers))
            @foreach ($customers as $customer)
                <x-user-card :user="$customer" />
            @endforeach
        @endif
    </div>
    </x-layout>