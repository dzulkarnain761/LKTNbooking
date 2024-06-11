@extends('layouts.guest')

@section('loginpage')
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Sila Masukkan Nombor Kad Pengenalan Untuk Sahkan Pengguna.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="get" action="{{ route('password.request_ic') }}" x-data>
        @csrf
        <!-- Email Address -->
        <div>
            <x-input-label for="ic_number" :value="__('No Kad Pengenalan')" />
            <x-text-input id="ic_number" class="block mt-1 w-full" type="text" name="ic_number" :value="old('ic_number')"
                autocomplete="ic_number" x-mask="999999-99-9999" placeholder="000000-00-0000" />
            <x-input-error :messages="$errors->get('ic_number')" class="mt-2" />
        </div>


        <div class="flex flex-col mt-4 space-y-4">
            <div class="self-start">
                <a class="underline text-sm font-semibold text-indigo-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Kembali Ke Log Masuk') }}
                </a>
            </div>
            <x-primary-button>
                {{ __('Sahkan Kad Pengenalan') }}
            </x-primary-button>
        </div>
    </form>
@endsection
