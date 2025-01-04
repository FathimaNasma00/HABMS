<x-auth-session-status class="mb-4" :status="session('status')"/>

<div class="w-full max-w-lg  bg-white rounded-[20px] shadow-lg bg-gradient-to-r from-[#c6e0e9] to-[#c6e1df]">
    <h2 class="pl-6 pb-2 mb-6 rounded-t-[20px] pt-2 text-2xl font-bold text-start text-gray-500 font-bold bg-gradient-to-r from-[#b1dae7] to-[#b0dfd6]">
        Login</h2>
    <form class="pl-6 pr-6" method="POST" action="{{ route('login') }}">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger text-center">
                <ul>
                    @foreach ($errors->all() as $error)
                        <x-input-error :messages="$error" class="mt-2 mb-4"/>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="mb-4">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-500">Mobile Numbers</label>
            <x-text-input id="mobile_number" class="block mt-1 w-full" type="text" name="mobile_number"
                          :value="old('mobile_number')" required placeholder="07XXXXXXXX"
                          autofocus autocomplete="username" maxlength="10"/>
{{--            <x-input-error :messages="$errors->get('mobile_number')" class="mt-2"/>--}}
        </div>
        <div class="mb-4">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-500">Password</label>
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2"/>--}}
        </div>
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </div>
            <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Forgot Your
                Password?</a>
        </div>
        <div class="flex justify-center">
            <button type="submit"
                    class="w-2/4 text-center px-4 py-2 text-sm font-bold text-white rounded-full border-4 border-white bg-gradient-to-r from-blue-400
                                to-green-400 rounded-lg hover:from-blue-500 hover:to-green-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-1">
                LOGIN
            </button>
        </div>
    </form>
    <p class="mt-6 text-sm text-center text-gray-600 pb-6">
        Don't have an account? <a href="{{route('home.register')}}"
                                  class="font-medium text-blue-500 hover:underline">Register</a> Now.
    </p>
</div>


{{--<div class="rounded-lg bg-gradient-to-r from-cyan-500 to-blue-500 p-16">--}}
{{--    <span class="ms-2 text-lgtext-gray-600">{{ __('Login') }}</span>--}}

{{--    <form method="POST" action="{{ route('login') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email Address')"/>--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required--}}
{{--                          autofocus autocomplete="username"/>--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2"/>--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')"/>--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                          type="password"--}}
{{--                          name="password"--}}
{{--                          required autocomplete="current-password"/>--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2"/>--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div class="flex items-center justify-between mt-4 space-x-8">--}}
{{--            <label for="remember_me" class="inline-flex items-center">--}}
{{--                <input id="remember_me" type="checkbox"--}}
{{--                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
{{--                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}

{{--            @if (Route::has('password.request'))--}}
{{--                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"--}}
{{--                   href="{{ route('password.request') }}">--}}
{{--                    {{ __('Forgot your password?') }}--}}
{{--                </a>--}}
{{--            @endif--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-center mt-4">--}}
{{--            <x-primary-button class="ms-3">--}}
{{--                {{ __('Log in') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-center mt-4 space-x-2">--}}
{{--            <span class="ms-2 text-sm text-gray-600">{{ __("Don't have an account? ") }}</span>--}}
{{--            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"--}}
{{--               href="{{ route('password.request') }}">--}}
{{--                {{ __('Register') }}--}}
{{--            </a>--}}
{{--            <span class="ms-2 text-sm text-gray-600">{{ __("Now.") }}</span>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</div>--}}



