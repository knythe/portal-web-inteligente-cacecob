<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Create categorias')

@push('css')

@endpush


@section('content')
<!--Contenido-->

<form action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" style="padding-left: 40px; padding-right: 40px;">
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">name category</span>
            <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <input name="nombre" type="text"
                    class="block w-full pr-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    placeholder="name category" />
                <div class="absolute inset-y-0 right-0 flex items-center mr-3 pointer-events-none">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="1.5" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path d="M6 6h.008v.008H6V6Z" />
                    </svg>
                </div>
            </div>
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">description</span>
            <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <textarea name="descripcion" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3"
                    placeholder="description to category" style="height: 128px;"></textarea>
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