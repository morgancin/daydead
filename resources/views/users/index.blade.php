<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('USUARIOS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="center  ">
                       <!--<h1 class="text-center">LISTADO USUARIOS </h1>-->
                    </div>

                   <!-- Boton de crear registro-->
                    <div class="flex items-center place-content-end ">
                        <div class="container-1 p1">
                            <a href="{{ route('users.register') }}" class="bg-green-900
                            sm:text-sm
                           hover:bg-green-600
                           text-white
                           font-bold
                           py-3
                           px-4 rounded p-1">Crear Registro</a>
                        </div>
                    </div>
                    <!--Fin -->

                    <form action="{{ route('users.delete') }}" method="POST" name="frmDelete" id="frmDelete">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="hidUser" id="hidUser" />
                    </form>

                    <!-- Busqueda -->
                    <form action="{{ route('users') }}" autocomplete="nope" method="POST">
                        @csrf

                        <div date-rangepicker class="flex items-center place-content-end">
                            <!-- Busqueda por nombre y lugar -->
                            <div>
                                <div class=" container-1 py-3">
                                    <input type="text" class="border
                                                                rounded-lg
                                                                border-grey-900
                                                                sm:text-sm
                                                                pl-10 p-2.5 w-96"
                                            name="txtSearch" placeholder="Buscar por nombre o código" @if(@isset($cSearch)) value="{{ $cSearch }}" @endif autocomplete="off" />

                                    <button type="submit" class="bg-gray-600 hover:bg-gray-900 text-white font-bold py-2 px-9 rounded">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </form>

                        <!-- Comienzo de la tabla  -->
                        <div class="flex flex-col p-2">
                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">

                                    <div class="overflow-hidden">
                                        <table class="min-w-full">
                                            <thead class="border-b">
                                                <tr class=" border border-b-indigo-500">
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">CÓDIGO</th>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">NOMBRE</th>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">EMAIL</th>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">LUGAR</th>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">GERENTE</th>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">ACCIONES</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse($oUsers as $user)
                                                    <tr class="border-b">
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $user->code }}</td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $user->place }}</td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $user->manager }}</td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                            <a href="#" onClick="event.preventDefault(); document.getElementById('hidUser').value = '{{ $user->id }}'; document.getElementById('frmDelete').submit();" class="text-red-600 hover:underline">Eliminar</a>
                                                            |
                                                            <a href="{{ route('users.edit', $user->id) }}" class="text-teal-800 hover:underline">Editar</a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="border-b">
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">No se encontraron registros</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Fin de la tabla -->
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
