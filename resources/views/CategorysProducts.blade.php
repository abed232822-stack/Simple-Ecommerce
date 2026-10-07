<x-layout>
    <div class="w-full flex justify-center text-5xl mb-10">
        {{ $category->name }}
    </div>
    @if (count($products)==0)
        <p class="text-4xl">there is nothing to show lil nigga</p>
    @else
    <div class="mx-20 mt-10">
        <div class="flex flex-wrap gap-4">
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
    @endif
    </x-layout>