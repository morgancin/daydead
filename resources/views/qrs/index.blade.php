<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QRS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alerts -->
       @if(session('message'))
       <div class="{{ (session('success')) ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' }} px-4 py-3 rounded relative" role="alert">
           <span class="block sm:inline">{{ session('message') }}</span>
           <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
               <svg class="fill-current h-6 w-6 {{ (session('success')) ? 'text-green-500' : 'text-red-500' }}" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"></svg>
           </span>
       </div>
   @endif
          <!--Fin de Alerts -->
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

                        <div date-rangepicker class="flex items-center place-content-start">
                            <!-- Busqueda por nombre y lugar -->
                            <div>
                                <div class=" container-1 py-3">
                                    <input type="text" class="border
                                                                rounded-lg
                                                                border-gray-900
                                                                sm:text-sm
                                                                pl-10 p-2.5 w-96"
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
                        <!-- -->
                        <nav aria-label="Page navigation example">
                            <ul class="inline-flex items-center -space-x-px">
                              <li>
                                <a href="#" class="block py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                  <span class="sr-only">Previous</span>
                                  <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                </a>
                              </li>
                              <li>
                                <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                              </li>
                              <li>
                                <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                              </li>
                              <li>
                                <a href="#" aria-current="page" class="z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                              </li>
                              <li>
                                <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
                              </li>
                              <li>
                                <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
                              </li>
                              <li>
                                <a href="#" class="block py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                  <span class="sr-only">Next</span>
                                  <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                </a>
                              </li>
                            </ul>
                          </nav>
                        <!-- -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
