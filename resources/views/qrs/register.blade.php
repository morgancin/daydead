<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('qrs.register.store') }}" novalidate>
            @csrf

            <!-- Place -->
            <div>
                <x-input-label for="place_id" :value="__('Place')" />

                <x-text-input id="place_id" class="block mt-1 w-full" type="text" name="place_id" :value="old('place_id')" required autofocus />

                <x-input-error :messages="$errors->get('place_id')" class="mt-2" />
            </div>

            <x-primary-button class="mt-4 w-full justify-center">
                {{ __('Guardar') }}
            </x-primary-button>
        </form>
    </x-auth-card>
</x-guest-layout>
