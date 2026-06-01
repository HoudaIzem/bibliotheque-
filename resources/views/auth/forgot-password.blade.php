@extends('layouts.app')

@section('title', '- Forgot Password')

@section('content')
<div class="min-h-screen flex items-center justify-center pt-24">

    <div class="w-full max-w-md bg-white p-6 rounded shadow">

        <div class="mb-4 text-sm text-gray-600">
            {{ __('forgot_password_info') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input
                    id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('email_password_reset_link') }}
                </x-primary-button>
            </div>
        </form>

    </div>

</div>
@endsection
