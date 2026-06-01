@extends('layouts.app')

@section('title', '- Confirm Password')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-start bg-gray-100">

    <!-- Navbar placeholder -->
    <div class="w-full bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">
                        MyApp
                    </a>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Home</a>
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="flex-1 flex items-center justify-center w-full mt-12">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow">

            <div class="mb-6 text-sm text-gray-600">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />

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

                <div class="flex justify-end">
                    <x-primary-button>
                        {{ __('Confirm') }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection
