<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('LUGARES') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl  sm:px-6 lg:px-8 md:flex md:justify-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg content-center">
                <div class="p-6 bg-white border-b border-gray-200 content-cente">
                    <form method="POST" action="{{ ! $oPlace->id ? route('places.store') : route('places.update')}}" novalidate>
                        @csrf

                        @if($oPlace->id)
                            @method('PUT')

                            <input type="hidden" name="hidPlace" id="hidPlace" value="{{ $oPlace->id }}" />
                        @endif

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nombre')" />

                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $oPlace->name)" required autofocus />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Code -->
                        <div>
                            <x-input-label for="code" :value="__('Clave')" />

                            <x-text-input type="text" name="code" id="code" class="block mt-1 w-full" :value="old('code', $oPlace->code)" required autofocus />

                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                        </div>

                        <x-primary-button class="mt-4 w-full justify-center">
                            {{ __('Guardar') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
