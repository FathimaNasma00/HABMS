<x-auth-session-status class="mb-4" :status="session('status')"/>

<div class="w-full max-w-lg  bg-white rounded-[20px] shadow-lg bg-gradient-to-r from-[#c6e0e9] to-[#c6e1df]">
    <h2 class="pl-6 pb-2 mb-6 rounded-t-[20px] pt-2 text-2xl font-bold text-start text-gray-500 font-bold bg-gradient-to-r from-[#b1dae7] to-[#b0dfd6]">
        Register</h2>
<form class="pl-6 pr-6" method="POST" action="{{ route('register') }}">
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

    <!-- Name -->
    <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-500">Name</label>
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                      autofocus autocomplete="name" placeholder="e.g., john"/>
{{--        <x-input-error :messages="$errors->get('name')" class="mt-2"/>--}}
    </div>

    <div class="mt-4">
        <label for="mobile_number" class="block mb-2 text-sm font-medium text-gray-500">Mobile Number</label>
        <x-text-input id="mobile_number" class="block mt-1 w-full" type="tel" name="mobile_number" :value="old('mobile_number')" required
                      autocomplete="username" placeholder="e.g., 07XXXXXXXX" maxlength="10"/>
{{--        <x-input-error :messages="$errors->get('mobile_number')" class="mt-2"/>--}}
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-500">Email</label>
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                      autocomplete="username" placeholder="e.g., user@mail.com"/>
{{--        <x-input-error :messages="$errors->get('email')" class="mt-2"/>--}}
    </div>

    <!-- Password -->
    <div class="mt-4">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-500">Password</label>

        <x-text-input id="password" class="block mt-1 w-full"
                      type="password"
                      name="password"
                      required autocomplete="new-password"/>

{{--        <x-input-error :messages="$errors->get('password')" class="mt-2"/>--}}
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-500">Confirm Password</label>

        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                      type="password"
                      name="password_confirmation" required autocomplete="new-password"/>

{{--        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>--}}
    </div>

    <div class="flex items-center justify-end mt-4 mb-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
           href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <button type="submit"
                class="ms-4 text-center px-4 py-2 text-sm font-bold text-white rounded-full border-4 border-white bg-gradient-to-r from-blue-400
                                to-green-400 rounded-lg hover:from-blue-500 hover:to-green-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-1">
            Register
        </button>
    </div>
</form>
</div>