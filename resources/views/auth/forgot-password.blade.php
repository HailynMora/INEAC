@extends('principal')
@section('content')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
            <br>
            <img src="{{url('img/logo.png')}}" width="500" class="img-fluid" alt="Cargando Imagen...">
            </a>
        </x-slot>

        <div class="mb-4 text-lg text-gray-600">
            {{ __('Reestablecer Contraseña') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Correo electronico')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Enviar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

@endsection