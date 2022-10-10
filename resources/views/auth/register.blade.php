<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nombre')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- User ID Leader -->
            <div>
                <x-input-label for="leader_user_id" :value="__('User ID Leader')" />

                <x-text-input type="text" name="leader_user_id" id="leader_user_id" class="block mt-1 w-full" :value="old('leader_user_id')" required autofocus />

                <x-input-error :messages="$errors->get('leader_user_id')" class="mt-2" />
            </div>

            <!-- Code -->
            <div>
                <x-input-label for="code" :value="__('Clave')" />

                <x-text-input type="text" name="code" id="code" class="block mt-1 w-full" :value="old('code')" required autofocus />

                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>

            <!-- Place -->
            <div>
                <x-input-label for="place" :value="__('Lugar')" />

                <x-text-input type="text" name="place" id="place" class="block mt-1 w-full" :value="old('place')" required autofocus />

                <x-input-error :messages="$errors->get('place')" class="mt-2" />
            </div>


            <!-- Manager -->
            <div>
                <x-input-label for="manager" :value="__('Gerente')" />

                <x-text-input type="text" name="manager" id="manager" class="block mt-1 w-full" :value="old('manager')" required autofocus />

                <x-input-error :messages="$errors->get('manager')" class="mt-2" />
            </div>


















            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!--
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
            -->



            <x-primary-button class="mt-4 w-full justify-center">
                {{ __('Crear Cuenta') }}
            </x-primary-button>

        </form>
    </x-auth-card>
</x-guest-layout>
