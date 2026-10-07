<x-layout>
    <div class="mb-45">
        <div class="w-full flex justify-center text-3xl">
            {{ $user->name }} Orders
        </div>
        <div class="flex justify-center">
            <div class="flex flex-col gap-y-5">
                @foreach ($orders as $order)
                    <x-CustomerOrder-Admin :order="$order" />
                @endforeach
            </div>
        </div>
    </div>
    </x-layout>