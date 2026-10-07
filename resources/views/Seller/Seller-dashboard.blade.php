<x-layout>
    <div class="flex flex-col gap-y-4">
        @php
            if ($products->isEmpty())
            {
                $message="You don't have any products yet";
            }
            else
            {
                $message='Your Products';
            }
        @endphp
        <x-big-heading>{{ $message }}</x-big-heading>
        @foreach ($products as $product)
            <div class="flex items-center justify-center my-5">
                    <x-dashboard-product :product="$product" :quantity="$product->quantity" />
            </div>
        @endforeach
    </div>
</x-layout>
