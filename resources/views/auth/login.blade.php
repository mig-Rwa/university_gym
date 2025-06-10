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

        <!-- Right Section: Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center px-8 py-16">
            <div class="w-full max-w-md space-y-6">
                <h2 class="text-3xl font-extrabold text-gray-800">Sign In</h2>
                <p class="text-sm text-gray-500">
                    New here?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Create an account</a>
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block w-full" type="email" name="email" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block w-full" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-200">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif
                    </div>

                    <x-primary-button class="w-full">
                        {{ __('Log in') }}
                    </x-primary-button>
                </form>

                <div class="text-center text-xs text-gray-400 pt-6">
                    &copy; {{ date('Y') }} METU NCC Sports Center. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
