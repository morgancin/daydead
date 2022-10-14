<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PROSPECTOS') }}
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

                    <form action="{{ route('leads') }}" autocomplete="nope" method="POST">
                        @csrf

                        <!-- Search -->
                        <div date-rangepicker class="flex items-center place-content-end">
                            <!-- Search by name and place -->
                            <div>
                                <div class=" container-1 p-3">
                                    <input type="search" name="txtSearch" class=" border
                                                rounded-lg
                                                border-purple-900
                                                sm:text-sm
                                                pl-10 p-2.5 w-48"
                                                id="search" placeholder="Buscar por Asesor" @if(@isset($cSearch)) value="{{ $cSearch }}" @endif />

                                    <input type="search" name="txtSearchPlace" class="border
                                                rounded-lg
                                                border-purple-900
                                                sm:text-sm
                                                pl-10 p-2.5 w-48"
                                                id="searchplace" placeholder="Buscar Lugar" @if(@isset($cSearchPlace)) value="{{ $cSearchPlace }}" @endif />
                                </div>
                            </div>

                            <!-- Busqueda por nombre y lugar -->
                            <div class="relative items center">
                                <div class="flex absolute  inset-y-0 left-0  items-center pl-3  pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                    <input type="date" name="txtSearchFchI" class="
                                                                    border
                                                                    border-purple-900
                                                                    sm:text-sm
                                                                    rounded-lg
                                                                    block w-48 pl-10 p-2.5"
                                                                placeholder="Fecha de Inicio" @if(@isset($cSearchFchI)) value="{{ $cSearchFchI }}" @endif />
                            </div>

                            <span class="mx-1 text-gray-500">a</span>

                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input type="date" name="txtSearchFchF" class="
                                                                border
                                                                border-purple-900
                                                                sm:text-sm
                                                                rounded-lg
                                                                block w-48 pl-10 p-2.5"
                                                        placeholder="Fecha Fin" @if(@isset($cSearchFchF)) value="{{ $cSearchFchF }}" @endif />
                            </div>

                            <div>
                                <select name="cmbSearch" id="cmbSearch" class="rounded-md shadow-sm border-bg-slate-900 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-48">
                                    <option value="">Linea de negocio</option>
                                    <option @if(@isset($cSearchBusiness)) @if($cSearchBusiness === 'PF') selected @endif @endif value="PF">PREVENCIÓN FINAL</option>
                                    <option @if(@isset($cSearchBusiness)) @if($cSearchBusiness === 'SG') selected @endif @endif value="SG">SANTA GLORIA</option>
                                    <option @if(@isset($cSearchBusiness)) @if($cSearchBusiness === 'BF') selected @endif @endif value="BF">BYE BYE FRIEND</option>
                                </select>
                            </div>

                            <div class="p-3">
                                <button class="bg-gray-600 hover:bg-gray-900 text-white font-bold py-2 px-9 rounded">Buscar</button>
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
                                            <tr class="border border-b-indigo-500">
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left"></th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">NOMBRE</th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">EMAIL</th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">TELÉFONO</th>

                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">ASESOR</th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">GERENTE</th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">LUGAR</th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">NEGOCIO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($oLeads as $leads)
                                                <tr class="border-b">
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $leads->created_at->format('d/m/Y H:i:s') }}</td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $leads->name }}</td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $leads->email }}</td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $leads->phone }}</td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $leads->qr->user->name }}</td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $leads->qr->user->manager }}</td>

                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ (isset($leads->place->name)) ? $leads->place->name : '' }}</td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $leads->business_line_text }}</td>
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
