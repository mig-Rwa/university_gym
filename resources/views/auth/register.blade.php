<x-guest-layout>
    <div class="flex min-h-screen">
        <!-- Left Section: Gym Branding -->
        <div class="hidden lg:flex w-1/2 bg-[url('/images/gym_bg.jpg')] bg-cover bg-center relative">
            <div class="absolute inset-0 bg-black/60"></div>
            <div class="relative z-10 m-auto text-center text-white px-6">
                <h1 class="text-5xl font-bold">METU NCC Sports Center</h1>
                <p class="text-xl mt-4">Train Smart. Live Strong.</p>
            </div>
        </div>

        <!-- Right Section: Registration Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center px-8 py-16">
            <div class="w-full max-w-md space-y-6">
                <h2 class="text-3xl font-extrabold text-gray-800">Create an Account</h2>
                <p class="text-sm text-gray-500">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Sign in</a>
                </p>

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block w-full" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                    <x-primary-button class="w-full">
                        {{ __('Register') }}
                    </x-primary-button>
                </form>

                <div class="text-center text-xs text-gray-400 pt-6">
                    &copy; {{ date('Y') }} METU NCC Sports Center. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
