<!-- resources/views/auth/passwords/reset_ic.blade.php -->

@extends('layouts.guest')

@section('loginpage')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <form method="POST" action="{{ route('password.update_ic') }}" x-data>
                            @csrf

                            <!-- IC -->
                            <div class="mt-4">
                                <x-input-label for="ic_number" :value="__('No Kad Pengenalan')" />
                                <x-text-input id="ic_number" class="block mt-1 w-full" type="text" name="ic_number"
                                    :value="old('ic_number')" autocomplete="ic_number" x-mask="999999-99-9999"
                                    placeholder="000000-00-0000" />
                                <x-input-error :messages="$errors->get('ic_number')" class="mt-2" />
                            </div>


                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Kata Laluan')" />

                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    autocomplete="current-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                    name="password_confirmation" autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>


                            <div class="flex flex-col items-center mt-4 space-y-2">

                                <x-primary-button class="w-full">
                                    {{ __('Tukar Kata Laluan') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
