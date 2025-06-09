<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Update usuarios')

@push('css')

@endpush


@section('content')
<!--Contenido-->


<form action="{{ route('usuarios.update', $usuario-> id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" style="padding-left: 40px; padding-right: 40px;">
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Names</span>
            <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <input name="name" type="text" value="{{$usuario -> name ?? ''}}"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Jane Doe" />
            </div>
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">email</span>
            <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <input name="email" type="email" value="{{$usuario -> email ?? ''}}"
                    class="block w-full pr-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    placeholder="email@cacecob.eirl" />
                <div class="absolute inset-y-0 right-0 flex items-center mr-3 pointer-events-none">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">photo (optional)</span>
            <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <input name="photo" type="file"
                    class="block w-full pr-10 mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="user_avatar_help" id="user_avatar">
                <div class="absolute inset-y-0 right-0 flex items-center mr-3 pointer-events-none">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="1.5" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                        <path d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                    </svg>
                </div>
            </div>
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">reset password (optional)</span>
            <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <input name="password" type="text"
                    class="block w-full pr-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    placeholder="new password" />
                <div class="absolute inset-y-0 right-0 flex items-center mr-3 pointer-events-none">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="1.5" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                    </svg>
                </div>
            </div>
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">
                Rol
            </span>
            <select name="rol" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                @foreach ($roles as $item)
                <option value="{{ $item->name }}" @selected(in_array($item->name, $usuario->roles->pluck('name')->toArray()))>
                    {{ $item->name }}
                </option>
                @endforeach
            </select>
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