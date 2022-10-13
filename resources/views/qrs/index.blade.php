<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QRS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('message'))
                <div class="{{ (session('success')) ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' }} px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 {{ (session('success')) ? 'text-green-500' : 'text-red-500' }}" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="center  ">
                       <!--<h1 class="text-center">LISTADO USUARIOS </h1>-->
                    </div>

                   <!-- Boton de crear registro-->
                    <div class="flex items-center place-content-end ">
                        <div class="container-1 p1">
                            <a href="{{ route('qrs.register') }}" class="bg-green-900
                            sm:text-sm
                           hover:bg-green-600
                           text-white
                           font-bold
                           py-3
                           px-4 rounded p-1">Crear Registro</a>
                        </div>
                    </div>
                    <!--Fin -->

                    <form action="{{ route('qrs.delete') }}" method="POST" name="frmDelete" id="frmDelete">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="hidQr" id="hidQr" />
                    </form>

                    <!-- Busqueda -->
                    <form action="{{ route('qrs') }}" autocomplete="nope" method="POST">
                        @csrf

                        <div date-rangepicker class="flex items-center place-content-end">
                            <!-- Busqueda por nombre y lugar -->
                            <div>
                                <div class=" container-1 py-3">
                                    <input type="text" class="border
                                                                rounded-lg
                                                                border-gray-900
                                                                sm:text-sm
                                                                pl-10 p-2.5 w-90"
                                            name="txtSearch" placeholder="Buscar por usuario" @if(@isset($cSearch)) value="{{ $cSearch }}" @endif autocomplete="off" />

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
                                      <tr class="border border-b-indigo-500">
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            USUARIO
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            LUGAR
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            NEGOCIO
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            ACCIONES
                                        </th>
                                      </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($oQrs as $qr)
                                            <tr class="border-b">
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $qr->user->name }}</td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ (isset($qr->place->name)) ? $qr->place->name : '' }}</td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $qr->business_line_text }}</td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    <a href="#" onClick="event.preventDefault(); document.getElementById('hidQr').value = '{{ $qr->id }}'; document.getElementById('frmDelete').submit();" class="text-red-600 hover:underline">Eliminar</a>
                                                    |
                                                    <a href="{{ url("download/qrcodes/$qr->src") }}" class="text-teal-800 hover:underline" download>Descargar</a>
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
                        <!-- Fin de la tabla   -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
