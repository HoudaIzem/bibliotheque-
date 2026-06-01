@extends('layouts.app')

@section('title', __('register'))

@section('content')
<div class="min-h-screen flex flex-col items-center pt-10 pb-20">

    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800">{{ __('register_title') }}</h2>
        <p class="text-gray-500 text-sm">{{ __('register_subtitle') }}</p>
    </div>

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg border border-gray-100">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Name')" class="font-semibold" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" class="font-semibold" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="font-semibold" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-semibold" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-8">
                <a class="underline text-sm text-gray-600 hover:text-indigo-600 transition" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection
