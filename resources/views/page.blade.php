<x-layout>
    <div class="max-w-2xl mx-auto mb-10 space-y-5">
        <x-big-heading>{{ $title }}</x-big-heading>
        @foreach ($paragraphs as $paragraph)
            <p class="text-gray-600 leading-relaxed">{{ $paragraph }}</p>
        @endforeach
        <x-href-button href="/">Back to home</x-href-button>
    </div>
</x-layout>
