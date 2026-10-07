<x-layout>
    <div class="flex mb-20">
        <img src="{{ asset('images/Frame 760.png') }}" alt="Logo">
        <div class="flex flex-col mx-auto my-auto gap-y-7 ">
            <div class="space-y-5">
                <x-big-heading>Create An account</x-big-heading>
                <p>Enter your details below</p>
            </div>
            <form action=" {{ route('register.post') }}" method="Post" class="flex flex-col gap-y-7">
                @csrf
                <div class="flex flex-col">
                    <x-session-input placeHolder="name" name="name" />
                    <x-form-error name="name" />
                </div>
                <div class="flex flex-col">
                    <x-session-input placeHolder="Email" name="email" />
                    <x-form-error name="email" />
                </div>
                <div class="flex flex-col">
                    <x-session-input placeHolder="Password" name="password" type="password" />
                    <x-form-error name="password" />
                </div>
                <x-session-input placeHolder="Confirm Password" name="password_confirmation" type="password" />
                <div class="flex flex-col">
                    <select class="outline-0 " name="role">
                        <option value="customer">Customer</option>
                        <option value="seller">Seller</option>
                        </select>
                    <x-form-error name="role" />
                </div>
                <div>
                    <div class="flex justify-between">
                            <x-submit-button>Register</x-submit-button>
                        </div>
                    <p class="flex items-end mt-3 justify-center">Already have an account?<a href="/login" class="text-[#db4444] hover:underline">Login</a></p>

                </div>
            </form>
        </div>
    </div>
    </x-layout>