<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Clientes')

@push('css')

@endpush


@section('content')
<!--Contenido-->

<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <!-- avanced tale -->
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            <!-- Buscador: 8/12 -->
            <div class="w-full md:w-8/12">
                <form class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required="">
                    </div>
                </form>
            </div>

            <!-- Filtro: 3/12 -->
            <div class="w-full md:w-3/12 flex justify-end">
                <div class="flex items-center space-x-3 w-full md:w-auto">
                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                clip-rule="evenodd" />
                        </svg>
                        Filter
                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </button>

                    <!-- Dropdown con roles dinámicos -->
                    <div id="filterDropdown"
                        class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Filtrar por estado</h6>
                        <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">

                        </ul>
                    </div>
                </div>
            </div>

            <!-- Botón: 3/12 -->
            <div class="w-full md:w-3/12 flex justify-end">
                <div class="flex items-center space-x-3 w-full md:w-auto">
                    <a href="{{ route('usuarios.create') }}"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add cliente ?
                    </a>
                </div>
            </div>
        </div>
        <!-- end avanced tale -->
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Cliente</th>
                    <th class="px-4 py-3">DNI</th>
                    <th class="px-4 py-3">Telefono</th>
                    <th class="px-4 py-3">Cargo</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Registracion date</th>
                </tr>
            </thead>
            <tbody
                class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($clientes as $cliente)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->
                            <div
                                class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                <img
                                    class="object-cover w-full h-full rounded-full"
                                    src="{{ $cliente->photo }}"
                                    alt=""
                                    loading="lazy" />
                                <div
                                    class="absolute inset-0 rounded-full shadow-inner"
                                    aria-hidden="true"></div>
                            </div>
                            <div>
                                <p class="font-semibold">{{$cliente -> nombres ?? ''}} {{$cliente->apellidos ?? ''}}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    {{$cliente -> email}}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{$cliente->dni ?? '-'}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{$cliente->telefono ?? '-'}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{$cliente->cargo ?? '-'}}
                    </td>
                    <td class="px-4 py-3 text-xs estado-cliente" data-id="{{ $cliente->id }}">
                        @if ($cliente->estado == 1)
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            Visitante
                        </span>
                        @elseif ($cliente->estado == 2)
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            Interesado
                        </span>
                        @elseif ($cliente->estado == 3)
                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                            No interesado
                        </span>
                        @else
                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                            Contacto
                        </span>
                        @endif
                    </td>

                    <td class="px-4 py-3 text-sm">
                        {{\Carbon\Carbon::parse($cliente -> created_at)->format('d/m/Y')}}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!--- paginate -->

    <!--- end paginate -->

</div>
@endsection

@push('js')

@endpush