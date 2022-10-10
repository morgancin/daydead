<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
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
                            <button class="bg-lime-600
                                            sm:text-sm
                                           hover:bg-lime-900
                                           text-white
                                           font-bold
                                           py-2
                                           px-4 rounded p-1">
                                Crear Registro
                            </button>
                        </div>
                    </div>
                    <!--Fin -->

                    <!--Busqueda por Fecha -->
                    <div date-rangepicker class="flex items-center place-content-end">
                         <!-- Busqueda por nombre y lugar -->
                     <div class="">
                        <div class=" container-1 p-3">
                            <input class=" border
                                           rounded-lg
                                           border-purple-900
                                           sm:text-sm
                                           pl-10 p-2.5 w-90"
                                    type="search" id="nombre" placeholder="Buscar Nombre" />
                            <input class="border
                                          rounded-lg
                                          border-purple-900
                                          sm:text-sm
                                          pl-10 p-2.5 w-90"
                                    type="search" id="nombre" placeholder="Buscar Lugar" />


                        </div>
                     </div>
                     <!-- Busqueda por nombre y lugar -->
                        <div class="relative items center">
                            <div class="flex absolute  inset-y-0 left-0  items-center pl-3  pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </div>
                                <input name="inicio" type="text" class="
                                                                 border
                                                                 border-purple-900
                                                                 sm:text-sm
                                                                 rounded-lg
                                                                 block w-full pl-10 p-2.5"
                                                            placeholder="Fecha de Inicio">
                        </div>
                            <span class="mx-1 text-gray-500">to</span>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                             </div>
                                <input name="end" type="text" class="
                                                            border
                                                            border-purple-900
                                                            sm:text-sm
                                                            rounded-lg
                                                            block w-full pl-10 p-2.5"
                                                      placeholder="Fecha Fin">
                             </div>
                             <div class="p-3">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded p-1">
                                    Buscar
                                  </button>

                             </div>
                    </div>
                    <!--Fin -->
                        <!-- Comienzo de la tabla  -->
                        <div class="flex flex-col p-2">
                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                              <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                  <table class="min-w-full">
                                    <thead class="border-b">
                                      <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                          Id Usuario
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                          Nombre
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                          Codigo
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                          Email
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Lugar
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Manager
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Acciones
                                        </th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr class="border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                          Lorena
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                          111111
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                          lore.vtrinidad@gmail.com
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Iztapalapa, CDMX
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            -------------
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <button>Editar</button>
                                            |
                                            <button>Eliminar</button>
                                        </td>
                                      </tr>
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
