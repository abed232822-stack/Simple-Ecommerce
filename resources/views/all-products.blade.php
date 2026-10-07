<x-layout>
        <div>
                    <p class="font-bold text-3xl">All products</p>
                    <div class=" grid grid-cols-4 space-y-7 mt-10 pl-15 ">
                        @foreach ($products as $product)
                            <x-product-card :product="$product" ></x-product-card>                            
                        @endforeach
                    </div>
                </div>
    </x-layout>