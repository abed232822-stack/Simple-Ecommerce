<x-layout>
    <div class="mb-45">
        <div class="w-full flex justify-center text-3xl">
            {{ $user->name }} Products
        </div>
        <div class="flex justify-center">
            <div class="flex flex-col gap-y-5">
                @foreach ($products as $product)
                    <x-ProductsCard-Admin :product="$product"/>
                @endforeach
            </div>
        </div>
    </div>
    </x-layout>