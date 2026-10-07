{{-- @php
    dd($product->image)
@endphp --}}
<x-layout>
    <div class="flex mb-20">
        <div class="w-1/2 flex justify-center">
            <img src="{{ $product->image_url }}" alt="Logo" class=" ml-50">
        </div>
        <div class="flex flex-col mx-auto my-auto gap-y-7 ">
            <div class="space-y-5 border-b border-b-gray-400 ">
                <x-big-heading>{{ $product->name }}</x-big-heading>
                <div class="flex gap-2 flex-wrap">
                    {{-- @php
                    dd($product->cetegories);
                    @endphp --}}
                    @if (count($product->categories))
                        @foreach ($product->categories as $category)
                        <a href="{{ route('ShowCategoryProducts',$category) }}">
                            <span class="px-3 py-1 bg-gray-200 rounded-full text-sm">
                                {{ $category->name }}
                            </span>
                        </a>
                        @endforeach
                    @endif
                    </div>
                <p class="text-xl">${{ $product->price }}</p>
                <p class="text-xl">Left:{{ $product->quantity }}</p>
                <p class="max-w-sm">{{ $product->details }} </p>
            </div>
            <form action="{{ route('AddToCart' , $product)  }}" method="post" class="flex flex-col gap-y-7 ">
                @csrf
                <div class="flex flex-col items-center justify-center">
                    <x-quantity-buttons name="quantity" />
                    <x-form-error name="quantity" />
                </div>
                <x-submit-button>Add to cart</x-submit-button>
                
            </form>
        </div>
    </div>
    </x-layout>