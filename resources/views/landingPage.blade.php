<x-layout>
    <div class="space-y-12">
        <section class="space-y-8 border-b pb-6">
            <div>
                    <p class="font-bold text-3xl">Our Products</p>
                    <div class=" grid grid-cols-5 mx-40 mt-10 gap-x-4 ">
                        @foreach ($products as $product)
                            <x-product-card :product="$product" ></x-product-card>                            
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-center ">
                    <x-href-button href="{{ route('AllProducts') }}" >View all products</x-href-button>
                </div>
            </section>
    
        <section class="space-y-8 pb-6">
            <div>
                    <p class="font-bold text-3xl">Categories</p>
                    <div class=" grid grid-cols-6 mx-40 mt-10 gap-x-4 gap-y-3 ">
                        @foreach ($categories as $category)
                            <x-category-card :category="$category">{{ $category->name }}</x-category-card>
                        @endforeach
                        
                    </div>
                </div>
                <div class="flex justify-center ">
                    <x-href-button href="{{ route('AllCategories') }}" >View all categories</x-href-button>
                </div>
            </section>
    </div>
    </x-layout>
    