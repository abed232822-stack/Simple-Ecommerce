@props(['product'])
<x-layout>
    <div class="flex mb-20">
        <div class="flex justify-center w-2xl">
            <img src="{{ $product->image_url }}" alt="Logo" >
        </div>
        <div class="flex flex-col mx-auto my-auto gap-y-7 ">
            <form action="{{ route('SellerDashboard.update',[$product]) }}" method="Post" class="flex flex-col gap-y-7 " enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class=" flex flex-col space-y-5 border-b border-b-gray-400  ">
                    <x-big-heading>Editing {{ $product->name }}</x-big-heading>
                    <div class="flex flex-col">
                        <x-session-input name="price" placeHolder="Price" value="{{ $product->price }}" />
                        <x-form-error name="price" />
                    </div>
                    <div class="flex flex-col">                        
                        <x-session-input name="quantity" placeHolder="Quantity" type="number" value="{{ $product->quantity }}" />
                        <x-form-error name="quanitity" />
                    </div>
                    
                    <div class="flex flex-col">
                        <textarea class="resize-none h-30 p-2 border-2 border-gray-500 rounded-lg outline-0" placeholder="Details" name="details" >{{$product->details}}</textarea>        
                        <x-form-error name="details" />
                    </div>
                    <x-session-input type="file" name="image"  />
                </div>
                <x-submit-button>Update</x-submit-button>
                
            </form>
        </div>
    </div>
    </x-layout>