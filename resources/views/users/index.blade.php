<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('USUARIOS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                 <!-- Alerts -->
                 <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    <span class="font-medium"></span> El registro no se hizo correctamente.
                  </div>

                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                        <span class="font-medium"></span> El registro se hizo correctamente.
                    </div>
                    <!--Fin de Alerts -->
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

                        <div date-rangepicker class="flex items-center place-content-start">
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
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">QR</th>
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
                                                         <!--Iconos de identificacion qr -->
                                                        <td>
                                                            <svg class="h-5 w-5 text-green-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                              </svg>

                                                              <svg class="h-5 w-5 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                              </svg>
                                                        </td>
                                                        <!--Iconos de identificacion qr -->
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
