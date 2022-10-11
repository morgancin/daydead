<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('SEGUIMIENTOS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="center  ">
                       <!--<h1 class="text-center">LISTADO USUARIOS </h1>-->
                    </div>

                    <form action="{{ route('leads.delete') }}" method="POST" name="frmDelete" id="frmDelete">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="hidLead" id="hidLead" />
                    </form>

                    <form action="{{ route('leads') }}" autocomplete="nope" method="POST">
                        <!-- Search -->
                        <div date-rangepicker class="flex items-center place-content-end">
                            <!-- Search by name and place -->
                            <div>
                                <div class=" container-1 p-3">
                                    <input type="search" class=" border
                                                rounded-lg
                                                border-purple-900
                                                sm:text-sm
                                                pl-10 p-2.5 w-90"
                                            name="txtSearch" id="search" placeholder="Buscar Nombre" />

                                    <input type="search" class="border
                                                rounded-lg
                                                border-purple-900
                                                sm:text-sm
                                                pl-10 p-2.5 w-90"
                                            name="txtSearchPlace" id="searchplace" placeholder="Buscar Lugar" />

                                    <select name="cmbSearch" id="cmbSearch" class="rounded-md shadow-sm border-bg-slate-900 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-60">
                                        <option></option>
                                        <option value="PF">PREVENCIÓN FINAL</option>
                                        <option value="SG">SANTA GLORIA</option>
                                        <option value="BF">BYE BYE FRIEND</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Busqueda por nombre y lugar -->
                            <div class="relative items center">
                                <div class="flex absolute  inset-y-0 left-0  items-center pl-3  pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                    <input type="text" name="txtSearchFchI" class="
                                                                    border
                                                                    border-purple-900
                                                                    sm:text-sm
                                                                    rounded-lg
                                                                    block w-full pl-10 p-2.5"
                                                                placeholder="Fecha de Inicio" />
                            </div>

                            <span class="mx-1 text-gray-500">to</span>

                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input type="text" name="txtSearchFchF" class="
                                                                border
                                                                border-purple-900
                                                                sm:text-sm
                                                                rounded-lg
                                                                block w-full pl-10 p-2.5"
                                                        placeholder="Fecha Fin" />
                            </div>
                            <div class="p-3">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded p-1">Buscar</button>
                            </div>
                        </div>
                        <!--Fin -->
                    </form>

                    <!-- Comienzo de la tabla  -->
                        <div class="flex flex-col p-2">
                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                              <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">

                                    <table class="min-w-full">
                                        <thead class="border-b">
                                            <tr>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">NOMBRE</th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">EMAIL</th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">TELÉFONO</th>

                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">ASESOR</th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">LUGAR</th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">NEGOCIO</th>

                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($oLeads as $leads)
                                                <tr class="border-b">
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $leads->name }}</td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $leads->email }}</td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $leads->phone }}</td>

                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $leads->qr->user->name }}</td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $leads->qr->place->name }}</td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $leads->qr->businessline }}</td>

                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        <a href="#" onClick="event.preventDefault(); document.getElementById('hidLead').value = '{{ $leads->id }}'; document.getElementById('frmDelete').submit();" class="btn btn-default btn-sm float-left">Eliminar</a>
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
