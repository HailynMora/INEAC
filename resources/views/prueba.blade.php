@extends('principal')
@section('content')

<x-guest-layout>
     <x-auth-card>
     <x-slot name="logo">
          <a href="/">
          <br>
              <!-- <img src="{{url('img/logo.png')}}" width="500" class="img-fluid" alt="Cargando Imagen..."> -->
            </a>
            
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 letra_peq" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4 letra_peq" :errors="$errors" />

        @if(Session::has('errorInicio'))
                <div style="color:#022859;">
                {{Session::get('errorInicio')}}
                </div>
                <br><br>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label class="letras_log" for="email" :value="__('Correo')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" class="letras_log" :value="__('Contraseña')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <h5 class="ml-2 letra_log">{{ __('Recordar') }}</h5>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline  hover:text-gray-900 letra_peq" href="{{ route('password.request') }}" style="background-color:#FFFFFF;">
                        {{ __('Olvidó su contraseña?') }}
                    </a>
                @endif

                <x-button class="ml-3 ">
                   <span class="letra_but"> {{ __('Iniciar sesión') }}</span>
                </x-button>
            </div>
        </form>
        <br><br>
    </x-auth-card>
</x-guest-layout>
@endsection

