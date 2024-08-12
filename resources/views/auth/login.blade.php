@extends('layouts.main')
@section('content')
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class=" mt-1 w-full form-control" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full form-control" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mt-4 text-right text-white d-flex justify-content-between flex-column flex-sm-row">
            {{-- <span>
                Don't have an account? <a class="text-blue" href="{{ route('register') }}">Create One</a>
            </span> --}}


            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 "
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

        </div>

        <div class="flex items-center justify-end mt-4 ">

            <x-primary-button class="ml-3 form-control" style="background:#00acac !important">
                {{ __('Log in') }}
            </x-primary-button>
            {{-- <div class="block mt-4">
	<label for="remember_me" class="flex items-center">
		<input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
		<span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
	</label>
</div> --}}
        </div>
    </form>
@endsection
