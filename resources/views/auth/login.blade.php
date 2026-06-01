@extends('layouts.app')

@section('title', __('login'))

@section('content')

<div class="min-h-screen flex flex-col items-center pt-10 pb-20">

    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800">{{ __('login_title') }}</h2>
        <p class="text-gray-500 text-sm">{{ __('login_subtitle') }}</p>
    </div>

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg border border-gray-100">

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" class="font-semibold" />
                <x-text-input
                    id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="font-semibold" />
                <x-text-input
                    id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-8">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-indigo-600 transition"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3 px-6 py-3 bg-indigo-600 hover:bg-indigo-700">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection
