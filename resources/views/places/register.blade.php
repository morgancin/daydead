<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('places.register.store') }}" novalidate>
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nombre')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Code -->
            <div>
                <x-input-label for="code" :value="__('Clave')" />

                <x-text-input type="text" name="code" id="code" class="block mt-1 w-full" :value="old('code')" required autofocus />

                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>

            <x-primary-button class="mt-4 w-full justify-center">
                {{ __('Guardar') }}
            </x-primary-button>
        </form>
    </x-auth-card>
</x-guest-layout>
