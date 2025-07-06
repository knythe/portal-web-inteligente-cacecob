<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Dashboard')

@push('css')
<script>
    window.labelsSemana = @json($labelsSemana);
    window.clientesPorDia = @json($clientesPorDia);

    window.labelsMeses = @json($labels); // ya lo usas para el line chart
    window.interesadosData = @json($interesados);
    window.noInteresadosData = @json($noInteresados);
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


@endpush


@section('content')
<!--Contenido-->
<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
    <!-- Card -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Total clients
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                {{$totalclientes}} clients
            </p>
        </div>
    </div>
    <!-- Card -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Servicios disponibles
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                {{$serviciosdisponibles}} services
            </p>
        </div>
    </div>
    <!-- Card -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-red-700 bg-red-100 rounded-full dark:text-white dark:bg-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Categoria preferida
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                {{$nombreCategoria}}
            </p>
        </div>
    </div>
    <!-- Card -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Clientes potenciales
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                {{$clientespotenciales}} clients
            </p>
        </div>
    </div>
</div>
<div class="grid gap-6 mb-8 md:grid-cols-2">
    <div class="min-w-0 p-4 bg-white rounded-lg shadow dark:bg-gray-800">
        <!-- Título y botón en la misma fila -->
        <div class="flex items-center justify-between mb-4">
            <h4 class="font-semibold text-gray-800 dark:text-gray-300">
                Clients for day
            </h4>
            <button onclick="descargarGrafico('clientesSemanaChart', 'clientes_nuevos')"
                class="px-3 py-1 text-sm font-medium text-white bg-teal-600 rounded hover:bg-teal-700 transition">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
            </button>
        </div>

        <!-- Gráfico -->
        <canvas id="clientesSemanaChart" width="480" height="240"></canvas>
    </div>
    <div class="min-w-0 p-4 bg-white rounded-lg shadow dark:bg-gray-800">
        <!-- Título y botón en una sola fila -->
        <div class="flex items-center justify-between mb-4">
            <h4 class="font-semibold text-gray-800 dark:text-gray-300">
                Clients for month
            </h4>
            <button onclick="descargarGrafico('clientesLineChart', 'clientes_por_mes')"
                class="px-3 py-1 text-sm font-medium text-white bg-purple-600 rounded hover:bg-purple-700 transition">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
            </button>
        </div>

        <!-- Gráfico -->
        <canvas id="clientesLineChart" width="480" height="240"></canvas>
    </div>


 



</div>
@endsection

@push('js')

@endpush