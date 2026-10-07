
<x-layout>
    <div class="flex mb-20">
        <img src="{{ asset('images/Frame 760.png') }}" alt="Logo" >
        <div class="flex flex-col mx-auto my-auto gap-y-7 ">
            <form action="{{ route('AddProduct.store') }}" method="Post" class="flex flex-col gap-y-7 " enctype="multipart/form-data">
                @csrf
                <div class=" flex flex-col space-y-5 border-b border-b-gray-400 ">
                    <x-big-heading>Adding a new product</x-big-heading>
                    
                    <div class="flex flex-col">
                        <x-session-input name="name" placeHolder="Name"  />
                        <x-form-error name="name" />
                    </div>
                    <div class="flex flex-col">
                        <x-session-input name="price" placeHolder="Price" />
                        <x-form-error name="price" />
                    </div>
                    <div class="flex flex-col">                        
                        <x-session-input name="quantity" placeHolder="Quantity" type="number" />
                        <x-form-error name="quanitity" />
                    </div>
                    <div class="flex flex-col">                        
                        <x-session-input name="categories" placeHolder="Categories how to write : gaming,electronics"  />  
                        <x-form-error name="categories" />
                    </div>
                    <div class="flex flex-col">
                        <textarea class="resize-none h-30 p-2 border-2 border-gray-500 rounded-lg outline-0" placeholder="Details" name="details"></textarea>           
                        <x-form-error name="details" />
                    </div>
                    <x-session-input type="file" name="image" />
                </div>
                <x-submit-button>Add to store</x-submit-button>
                
            </form>
        </div>
    </div>
    </x-layout>