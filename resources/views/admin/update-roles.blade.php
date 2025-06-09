<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Update roles')

@push('css')

@endpush


@section('content')
<!--Contenido-->
<form action="{{ route('roles.update', $role-> id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" style="padding-left: 40px; padding-right: 40px;">
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">name</span>
            <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <input name="name" type="text" value="{{old('name', $role->name)}}"
                    class="block w-full pr-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    placeholder="name rol" />
                <div class="absolute inset-y-0 right-0 flex items-center mr-3 pointer-events-none">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="1.5" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
            </div>
        </label>

        <div class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">permissions</span>
            <div class="mt-2 space-y-2">
                @foreach ($permisos as $item)
                <label for="permiso-{{ $item->id }}" class="flex items-center text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                    <input
                        id="permiso-{{ $item->id }}"
                        type="checkbox"
                        name="permission[]"
                        value="{{ $item->id }}"
                        @if ($role->permissions->contains('id', $item->id)) checked @endif
                    class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    >
                    <span class="ml-2">{{ $item->name }}</span>
                </label>
                @endforeach
            </div>

        </div>


        </label>
        <div class="flex gap-4 mt-4">
            <button type="submit"
                class="w-full px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Send
            </button>

            <button type="reset"
                class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                clear
            </button>
        </div>
    </div>
</form>
@endsection

@push('js')

@endpush