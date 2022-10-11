<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QRS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-guest-layout>
                    <x-auth-card>
                        <x-slot name="logo">
                            <a href="/">
                                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                            </a>
                        </x-slot>

                        <form method="POST" action="{{ route('qrs.register.store') }}" novalidate>
                            @csrf

                            <!-- User -->
                            <div>
                                <x-input-label for="user_id" :value="__('Usuario')" />

                                <select
                                    id="user_id"
                                    name="user_id"
                                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
                                        <option>-- Seleccione --</option>
                                        @foreach($oUsers as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                </select>

                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>

                            <!-- Place -->
                            <div>
                                <x-input-label for="place_id" :value="__('Lugar')" />

                                <select
                                    id="place_id"
                                    name="place_id"
                                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
                                        <option>-- Seleccione --</option>
                                        @foreach($oPlaces as $place)
                                            <option value="{{ $place->id }}">{{ $place->name }}</option>
                                        @endforeach
                                </select>

                                <x-input-error :messages="$errors->get('place_id')" class="mt-2" />
                            </div>

                            <!-- Business -->
                            <div>
                                <x-input-label for="businessline" :value="__('Negocio')" />

                                <select
                                    id="businessline"
                                    name="businessline"
                                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
                                        <option>-- Seleccione --</option>
                                        <option value="PF">PREVENCIÓN FINAL</option>
                                        <option value="SG">SANTA GLORIA</option>
                                        <option value="BF">BYE BYE FRIEND</option>
                                </select>

                                <x-input-error :messages="$errors->get('businessline')" class="mt-2" />
                            </div>

                            <x-primary-button class="mt-4 w-full justify-center">
                                {{ __('Guardar') }}
                            </x-primary-button>
                        </form>
                    </x-auth-card>
                </x-guest-layout>
            </div>
        </div>
    </div>
</x-app-layout>
