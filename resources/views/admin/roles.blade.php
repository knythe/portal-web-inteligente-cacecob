<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Roles')

@push('css')

@endpush

@section('content')
<!--Contenido-->
<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                Dashboard
            </a>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Roles</span>
            </div>
        </li>
    </ol>
</nav>
<br>
<div x-data="deleteRoleModal()" @keydown.escape="closeModal()" class="relative">
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
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
                        <input type="text" id="searchInput" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required="">
                    </div>
                </form>
            </div>

            <!-- Filtro: 3/12 -->
            <div class="w-full md:w-3/12 flex justify-end">
                <div class="flex items-center space-x-3 w-full md:w-auto">
                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium
           text-gray-800 bg-gray-100 border border-gray-300 rounded-lg
           hover:bg-gray-200 hover:text-gray-900
           focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500
           dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600
           dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            class="h-4 w-4 mr-2 text-gray-600 dark:text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                clip-rule="evenodd" />
                        </svg>
                        Filter
                        <svg class="-mr-1 ml-1.5 w-5 h-5 text-gray-600 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </button>


                    <!-- Dropdown con roles dinámicos -->
                    <div id="filterDropdown" class="z-10 hidden w-48 p-3 rounded-lg shadow-lg bg-white text-gray-800 dark:bg-gray-800 dark:text-gray-100 border border-gray-200 dark:border-gray-600">
                        <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                            @foreach ($roles->pluck('name')->unique() as $roleName)
                            <li class="flex items-center">
                                <input
                                    type="checkbox"
                                    name="filter[]"
                                    value="{{ $roleName }}"
                                    id="filter-{{ \Illuminate\Support\Str::slug($roleName) }}"
                                    class="role-filter w-4 h-4 text-black border-gray-300 rounded focus:ring-black checked:bg-black checked:border-black dark:bg-gray-700 dark:border-gray-500 dark:checked:bg-black dark:checked:border-black">

                                <label for="filter-{{ \Illuminate\Support\Str::slug($roleName) }}"
                                    class="ml-2 text-sm font-medium text-gray-800 dark:text-gray-100">
                                    {{ $roleName }}
                                </label>

                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Botón: 3/12 -->
            <div class="w-full md:w-3/12 flex justify-end">
                <div class="flex items-center space-x-3 w-full md:w-auto">
                    <a href="{{ route('roles.create') }}"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add rol
                    </a>
                </div>
            </div>


        </div>
        <!-- end avanced tale -->
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap" id="rolesTable">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="text-center px-4 py-3">Name / Rol</th>
                        <th class="text-center px-4 py-3">Description</th>
                        <th class="text-center px-4 py-3">Date</th>
                        <th class="text-center px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($roles as $rol)
                    <tr class="text-gray-700 dark:text-gray-400 text-center">
                        <td class="px-4 py-3">
                            <div class="text-center text-sm">
                                <div>
                                    <p class="font-semibold">{{$rol -> name}}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if ($rol->permissions->isEmpty())
                            <div>No permissions</div>
                            @else
                            @foreach ($rol->permissions->chunk(3) as $grupo)
                            <div>
                                {{ $grupo->pluck('name')->implode(', ') }}
                            </div>
                            @endforeach
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{\Carbon\Carbon::parse($rol -> created_at)->format('d/m/Y')}}
                        </td>
                        <td class="px-4 py-3 text-center align-middle">
                            <div class="flex justify-center items-center gap-4 text-sm">
                                <a href="{{ route('roles.edit', ['role' => $rol]) }}"
                                    class="flex items-center justify-center px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Edit">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
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
                {{ $roles->firstItem() }}-{{ $roles->lastItem() }} of {{ $roles->total() }}
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
                                @if(!$roles->onFirstPage()) onclick="window.location='{{ $roles->previousPageUrl() }}'" @else disabled @endif
                                aria-label="Previous">
                                <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                    <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </li>

                        <!-- Page Numbers -->
                        @foreach ($roles->getUrlRange(1, $roles->lastPage()) as $page => $url)
                        @if ($page == $roles->currentPage())
                        <li>
                            <button
                                class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                                {{ $page }}
                            </button>
                        </li>
                        @elseif ($page == 1 || $page == $roles->lastPage() || ($page >= $roles->currentPage() - 1 && $page <= $roles->currentPage() + 1))
                            <li>
                                <button
                                    class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                                    onclick="window.location='{{ $url }}'">
                                    {{ $page }}
                                </button>
                            </li>
                            @elseif ($page == $roles->currentPage() - 2 || $page == $roles->currentPage() + 2)
                            <li>
                                <span class="px-3 py-1">...</span>
                            </li>
                            @endif
                            @endforeach

                            <!-- Next Button -->
                            <li>
                                <button
                                    class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                    @if($roles->hasMorePages()) onclick="window.location='{{ $roles->nextPageUrl() }}'" @else disabled @endif
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
</div>


@endsection

@push('js')
@endpush