<x-layout>
        <div>
                    <p class="font-bold text-3xl">All categories</p>
                    <div class=" grid grid-cols-6 space-y-7 mt-10 pl-15 ">
                        @foreach ($categories as $category)
                            <x-category-card :category="$category">{{ $category->name }}</x-category-card>                            
                        @endforeach
                    </div>
                </div>
    </x-layout>