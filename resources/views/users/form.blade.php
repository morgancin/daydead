<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('USUARIOS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl  sm:px-6 lg:px-8 md:flex md:justify-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg content-center">
                <div class="p-6 bg-white border-b border-gray-200 content-cente">
                    <form method="POST" action="{{ ! $oUser->id ? route('users.store') : route('users.update')}}" novalidate>
                        @csrf

                        @if($oUser->id)
                            @method('PUT')

                            <input type="hidden" name="hidUser" id="hidUser" value="{{ $oUser->id }}" />
                        @endif

                        <!-- Name -->
                        <div class="p-2">
                            <x-input-label for="name" :value="__('Nombre')" />

                            <x-text-input id="name" class="block mt-1 w-80" type="text" name="name" :value="old('name', $oUser->name)" required autofocus />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Code -->
                        <div class="p-2">
                            <x-input-label for="code" :value="__('Clave')" />

                            <x-text-input type="text" name="code" id="code" class="block pl-5 w-80" :value="old('code', $oUser->code)" required autofocus />

                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                        </div>

                        <!-- Place -->
                        <div class="p-2">
                            <x-input-label for="place" :value="__('Lugar')" />

                            <x-text-input type="text" name="place" id="place" class="block pl-5 w-80" :value="old('place', $oUser->place)" required autofocus />

                            <x-input-error :messages="$errors->get('place')" class="mt-2" />
                        </div>


                        <!-- Manager -->
                        <div class="p-2">
                            <x-input-label for="manager" :value="__('Gerente')" />

                            <x-text-input type="text" name="manager" id="manager" class="block pl-5 w-80" :value="old('manager', $oUser->manager)" required autofocus />

                            <x-input-error :messages="$errors->get('manager')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="p-2">
                            <x-input-label for="email" :value="__('Email')" />

                            <x-text-input type="email" name="email" id="email" class="block pl-5 w-80" :value="old('email', $oUser->email)" required />

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="p-2">
                            <x-input-label for="password" :value="__('Contraseña')" />

                            <x-text-input id="password" class="block pl-5 w-80"
                                                type="password"
                                                name="password"
                                                required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="p-2">
                            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

                            <x-text-input id="password_confirmation" class="block pl-5 w-80"
                                                type="password"
                                                name="password_confirmation" required />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="p-2" />
                        </div>

                        <x-primary-button class="mt-4 w-80 justify-center">
                            {{ __('Crear Cuenta') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
