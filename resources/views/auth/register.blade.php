@extends('layouts.guest')
@section('title', 'Register')
@section('loginpage')
    <form method="POST" action="{{ route('register') }}" x-data>
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Penuh')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus
                autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Nama Pengguna')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- IC -->
        <div class="mt-4">
            <x-input-label for="ic_number" :value="__('No Kad Pengenalan')" />
            <x-text-input id="ic_number" class="block mt-1 w-full" type="text" name="ic_number" :value="old('ic_number')"
                autocomplete="ic_number" x-mask="999999-99-9999" placeholder="000000-00-0000" />
            <x-input-error :messages="$errors->get('ic_number')" class="mt-2" />
        </div>  

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Nombor Telefon')" />
            <x-text-input id="phone_number" class=" block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')"
                autocomplete="phone_number" x-mask="999-99999999" placeholder="123-4567890"/>
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>



        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email (Optional)')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Laluan')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col mt-4 space-y-4">
            <div class="self-start">
                <a class="underline text-sm font-semibold text-indigo-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Sudah Mendaftar?') }}
                </a>
            </div>

            <x-primary-button class="w-full">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>
    </form>

@endsection
