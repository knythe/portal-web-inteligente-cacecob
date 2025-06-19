<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Servicios')

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

                    <!-- Dropdown con servicios dinámicos -->
                    <div id="filterDropdown"
                        class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Filtrar por rol</h6>
                        <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">

                        </ul>
                    </div>
                </div>
            </div>

            <!-- Botón: 3/12 -->
            <div class="w-full md:w-3/12 flex justify-end">
                <div class="flex items-center space-x-3 w-full md:w-auto">
                    <a href="{{ route('servicios.create') }}"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add servicio
                    </a>
                </div>
            </div>
        </div>
        <!-- end avanced tale -->
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="text-center px-4 py-3">Name / Titulo</th>
                    <th class="text-center px-4 py-3">precio <br> (S/.)</th>
                    <th class="text-center px-4 py-3">oferta <br> (S/.)</th>
                    <th class="text-center px-4 py-3">modalidad</th>
                    <th class="text-center px-4 py-3">horas <br>academicas <br>(H.A.)</th>
                    <th class="text-center px-4 py-3">Inicio</th>
                    <th class="text-center px-4 py-3">state</th>
                    <th class="text-center px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody
                class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($servicios as $servicio)
                <tr class="text-gray-700 dark:text-gray-400 text-center">
                    @php
                    $words = explode(' ', $servicio->titulo ?? 'no description');
                    @endphp
                    <td class="px-4 py-3">
                        <div class="text-center text-sm">
                            <div>
                                @foreach(array_chunk($words, 3) as $chunk)
                                {{ implode(' ', $chunk) }}<br>
                                @endforeach
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{$servicio->precio ?? ''}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{$servicio->oferta ?? 'sin oferta'}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        @if ($servicio->modalidad == 1)
                        Virtual
                        @elseif ($servicio->modalidad == 2)
                        Presencial
                        @else
                        Semipresencial
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{$servicio->horas_academicas ?? ''}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{\Carbon\Carbon::parse($servicio -> fecha_inicio)->format('d/m/Y')}}
                    </td>
                    <td class="px-4 py-3 text-xs estado-servicio" data-id="{{ $servicio->id }}">
                        @if ($servicio->estado == 1)
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            Active
                        </span>
                        @else
                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                            Inactive
                        </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center align-middle">
                        <div class="flex justify-center items-center gap-4 text-sm">
                            <a href="{{ route('servicios.edit', ['servicio' => $servicio]) }}"
                                class="flex items-center justify-center px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                aria-label="Edit">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                            </a>
                            <label class="inline-flex items-center me-5 cursor-pointer">
                                <input
                                    type="checkbox"
                                    class="sr-only peer toggle-estado"
                                    data-id="{{ $servicio->id }}"
                                    {{ $servicio->estado ? 'checked' : '' }}>

                                <div class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 
                                            peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 
                                            peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full 
                                            peer-checked:after:border-white after:content-[''] after:absolute 
                                            after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 
                                            after:border after:rounded-full after:h-5 after:w-5 after:transition-all 
                                            dark:border-gray-600 peer-checked:bg-purple-600 dark:peer-checked:bg-purple-600">
                                </div>

                            </label>


                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!--- paginate -->
    <div
        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">

        <span class="flex items-center col-span-3">
            Showing
            {{ $servicios->firstItem() }}-{{ $servicios->lastItem() }} of {{ $servicios->total() }}
        </span>

        <span class="col-span-2"></span>

        <!-- Pagination -->
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            <nav aria-label="Table navigation">
                <ul class="inline-flex items-center">

                    <!-- Previous Button -->
                    <li>
                        <button
                            class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                            @if(!$servicios->onFirstPage()) onclick="window.location='{{ $servicios->previousPageUrl() }}'" @else disabled @endif
                            aria-label="Previous">
                            <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                    </li>

                    <!-- Page Numbers -->
                    @foreach ($servicios->getUrlRange(1, $servicios->lastPage()) as $page => $url)
                    @if ($page == $servicios->currentPage())
                    <li>
                        <button
                            class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                            {{ $page }}
                        </button>
                    </li>
                    @elseif ($page == 1 || $page == $servicios->lastPage() || ($page >= $servicios->currentPage() - 1 && $page <= $servicios->currentPage() + 1))
                        <li>
                            <button
                                class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                                onclick="window.location='{{ $url }}'">
                                {{ $page }}
                            </button>
                        </li>
                        @elseif ($page == $servicios->currentPage() - 2 || $page == $servicios->currentPage() + 2)
                        <li>
                            <span class="px-3 py-1">...</span>
                        </li>
                        @endif
                        @endforeach

                        <!-- Next Button -->
                        <li>
                            <button
                                class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                @if($servicios->hasMorePages()) onclick="window.location='{{ $servicios->nextPageUrl() }}'" @else disabled @endif
                                aria-label="Next">
                                <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                    <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </li>

                </ul>
            </nav>
        </span>
    </div>
    <!--- end paginate -->

</div>
@endsection

@push('js')

@endpush