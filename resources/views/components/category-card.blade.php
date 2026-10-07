@props(['category'])
<a href="{{ route('ShowCategoryProducts',$category) }}">
    <div class="w-35 h-30 border border-gray-400 flex items-center justify-center text-lg font-bold hover:border-0 hover:bg-[#db4444] group transition-all duration-300">
        <p class="group-hover:text-white ">{{ $slot }}</p>
    </div>
</a>