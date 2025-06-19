<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Update servicios')

@push('css')

@endpush


@section('content')
<!--Contenido-->


<form action="{{ route('servicios.update', $servicio -> id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method ('PUT')
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" style="padding-left: 40px; padding-right: 40px;">
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">
                category
            </span>
            <select name="categoria_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                @foreach ($categorias as $item)
                <option value="{{$item->id}}" {{$servicio->categoria_id == $item->id ? 'selected' : ''}}>{{$item->nombre}}</option>
                @endforeach
            </select>
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">titulo</span>
            <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <input name="titulo" type="text" value="{{$servicio -> titulo}}"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Servicio Academico" />
            </div>
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">photo</span>
            <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <input name="imagen" type="file"
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
            <span class="text-gray-700 dark:text-gray-400">description</span>
            <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <textarea name="descripcion" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3"
                    placeholder="description to service" style="height: 128px;">{{$servicio -> descripcion}}</textarea>
            </div>
        </label>
        <div class="flex gap-x-4 mt-4">
            <!-- Precio -->
            <label class="w-1/2 text-sm">
                <span class="text-gray-700 dark:text-gray-400">price</span>
                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                    <input name="precio" type="number" value="{{$servicio->precio}}"
                        class="block w-full pr-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                        placeholder="000.00" />
                    <div class="absolute inset-y-0 right-0 flex items-center mr-3 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </div>
            </label>

            <!-- Oferta -->
            <label class="w-1/2 text-sm">
                <span class="text-gray-700 dark:text-gray-400">oferta (optional)</span>
                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                    <input name="oferta" type="number" value="{{$servicio->oferta}}"
                        class="block w-full pr-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                        placeholder="000.00" />
                    <div class="absolute inset-y-0 right-0 flex items-center mr-3 pointer-events-none">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                        </svg>
                    </div>
                </div>
            </label>
            <!-- modalidad --->
            <label class="w-1/2 text-sm">
                <span class="text-gray-700 dark:text-gray-400">modalidad</span>
                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                    <select name="modalidad" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        @php
                        $modalidades = [
                        "1" => "Virtual",
                        "2" => "Presencial",
                        "3" => "Hibrida (Semipresencial)",
                        ];
                        @endphp
                        @foreach ($modalidades as $value => $label)
                        <option value="{{$value}}" @if($servicio -> modalidad == $value) selected @endif>{{$label}}</option>
                        @endforeach
                    </select>
                </div>
            </label>
        </div>
        <div class="flex gap-x-4 mt-4">
            <!-- tipo certificado --->
            <label class="w-1/2 text-sm">
                <span class="text-gray-700 dark:text-gray-400">tipo de certificacion</span>
                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                    <select name="tipo_certificado" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        @php
                        $certificaciones = [
                        "1" => "Diploma",
                        "2" => "Certificado",
                        "3" => "Reconocimiento",
                        "4" => "Titulo",
                        ];
                        @endphp
                        @foreach ($certificaciones as $value => $label)
                        <option value="{{$value}}" @if($servicio -> tipo_certificado == $value) selected @endif>{{$label}}</option>
                        @endforeach
                    </select>
                </div>
            </label>
            <!-- horas academicas -->
            <label class="w-1/2 text-sm">
                <span class="text-gray-700 dark:text-gray-400">horas academicas</span>
                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                    <input name="horas_academicas" type="number" value="{{$servicio ->horas_academicas}}"
                        class="block w-full pr-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                        placeholder="H. A." />
                    <div class="absolute inset-y-0 right-0 flex items-center mr-3 pointer-events-none">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>
                    </div>
                </div>
            </label>

        </div>
        <div class="flex gap-x-4 mt-4">
            <!-- inicio --->
            <label class="w-1/2 text-sm">
                <span class="text-gray-700 dark:text-gray-400">start date</span>
                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                    <input name="fecha_inicio" type="date" value="{{$servicio ->fecha_inicio}}"
                        class="block w-full pr-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                        placeholder="H. A." />
                    <!--<input datepicker id="default-datepicker" type="text" class="block w-full pr-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Select date">-->
                </div>
            </label>

            <!-- fin -->
            <label class="w-1/2 text-sm">
                <span class="text-gray-700 dark:text-gray-400">end date</span>
                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                    <input name="fecha_fin" type="date" value="{{$servicio -> fecha_fin}}"
                        class="block w-full pr-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                        placeholder="H. A." />
                    <!--<input datepicker id="default-datepicker" type="text" class="block w-full pr-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Select date">-->
                </div>
            </label>

        </div>





        <div class="flex gap-4 mt-4">
            <a href="{{ route('servicios.index') }}" {{-- Ajusta la ruta si es necesario --}}
                class="px-3 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <-
                    </a>
                    <button type="reset"
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                        clear
                    </button>
                    <button type="submit"
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        update
                    </button>
        </div>
    </div>
</form>


@endsection

@push('js')

@endpush