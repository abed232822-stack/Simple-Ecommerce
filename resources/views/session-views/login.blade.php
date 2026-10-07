<x-layout>
    <div class="flex mb-20">
        <img src="{{ asset('images/Frame 760.png') }}" alt="Logo">
        <div class="flex flex-col mx-auto my-auto gap-y-7 ">
            <div class="space-y-5">
                <x-big-heading>Login to our Shop</x-big-heading>
                <p>Enter your details below</p>
            </div>
            <form action="{{ route('login.post') }}" method="POST" class="flex flex-col gap-y-7">
                @csrf
                <div class="flex flex-col">
                    <x-session-input placeHolder="Email" name="email" />
                    <x-form-error name="email" />
                </div>
                <div class="flex flex-col">
                    <x-session-input placeHolder="Password" name="password" type="password" />
                    <x-form-error name="password" />
                </div>
                <div>
                    <div class="flex justify-between">
                            <x-submit-button>Log in</x-submit-button>
                        </div>
                    <p class="flex items-end mt-3 justify-center">Dont have an account?<a href="/register" class="text-[#db4444] hover:underline">Register</a></p>

                </div>
            </form>
        </div>
    </div>
    </x-layout>