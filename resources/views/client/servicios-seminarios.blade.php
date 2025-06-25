<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seminarios | CACECOB</title>
    <link rel="icon" href="favicon.ico">
    <link href="/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <!--<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="../assets/js/init-alpine.js"></script>-->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body
    x-data="{ page: 'blog-grid', 'darkMode': true, 'stickyMenu': false, 'navigationOpen': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'b eh': darkMode === true}">
    <!-- ===== Header Start ===== -->

    <x-client.navigation-header />


    <!-- ===== Header End ===== -->

    <main>
        <!-- ===== Blog Grid Start ===== -->
        <section class="ji gp uq">
            <div class="bb ye ki xn vq jb jo">
                 <h2 class="text-2xl font-bold text-black text-start mb-6">Nuestros seminarios</h2>
                <div class="wc qf pn xo zf iq">
                    <!-- Blog Item -->
                    @foreach ($servicios as $servicio)
                    <div class="animate_top sg vk rm xm">
                        <div class="c rc i z-1 pg">
                            <img class="w-full" src="{{ asset('storage/' . $servicio->imagen) }}" alt="Blog" />

                            <div
                                class="im h r s df vd yc wg tc wf xf al hh/20 nl il z-10">
                                <a href="{{ route('portal.show', $servicio->id) }}" class="vc ek rg lk gh sl ml il gi hi">Leer más</a>
                            </div>
                        </div>

                        <div class="yh">
                            <div class="tc uf wf ag jq">
                                <div class="tc wf ag">
                                    <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                        {{$servicio -> categoria -> nombre}}
                                    </span>
                                    @if ($servicio->modalidad == 1)
                                    <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">
                                        Virtual
                                    </span>
                                    @elseif ($servicio->modalidad == 2)
                                    <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                        Presencial
                                    </span>
                                    @else
                                    <span class="flex items-center gap-1 px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                        Semipresencial
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <h4 class="ek tj ml il kk wm xl eq lb">
                                <a href="{{ route('portal.show', $servicio->id) }}">{{$servicio -> titulo}}</a>
                            </h4>
                            <br>
                            <hr>
                            <br>
                            <div class="tc wf ag">
                                <img src="/assets/img/icon-calender.svg" alt="Calender" />
                                <p>{{\Carbon\Carbon::parse($servicio -> fecha_inicio)->format('d/m/Y')}} - </p>
                                <p>{{$servicio->horas_academicas}} Horas Académicas</p>
                            </div>
                            <br>
                            <div class="text-end">
                                @if($servicio->oferta)
                                <span class="badge badge-warning line-through">Precio: S/. {{ $servicio->precio }}</span>
                                <span class="badge badge-error">Oferta: S/. {{ $servicio->oferta }}</span>
                                @else
                                <span class="badge badge-warning">Precio: S/. {{ $servicio->precio }}</span>
                                @endif
                            </div>
                        </div>

                    </div>
                    @endforeach

                </div>

                <!-- Pagination -->
                <div class="mb lo bq i ua">
                    <nav>
                        <ul class="tc wf xf bg">
                            {{-- Flecha Anterior --}}
                            @if ($servicios->onFirstPage())
                            <li>
                                <span class="c tc wf xf wd in zc hn rg uj fo wk xm ml il hh rm tl zm yl an opacity-50 cursor-not-allowed">
                                    <svg class="th lm ml il" width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.93884 6.99999L7.88884 11.95L6.47484 13.364L0.11084 6.99999L6.47484 0.635986L7.88884 2.04999L2.93884 6.99999Z" />
                                    </svg>
                                </span>
                            </li>
                            @else
                            <li>
                                <a class="c tc wf xf wd in zc hn rg uj fo wk xm ml il hh rm tl zm yl an" href="{{ $servicios->previousPageUrl() }}">
                                    <svg class="th lm ml il" width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.93884 6.99999L7.88884 11.95L6.47484 13.364L0.11084 6.99999L6.47484 0.635986L7.88884 2.04999L2.93884 6.99999Z" />
                                    </svg>
                                </a>
                            </li>
                            @endif

                            {{-- Números de página --}}
                            @foreach ($servicios->getUrlRange(1, $servicios->lastPage()) as $page => $url)
                            <li>
                                <a href="{{ $url }}" class="c tc wf xf wd in zc hn rg uj fo wk xm ml il hh rm tl zm yl an {{ $page == $servicios->currentPage() ? 'bg-purple-600 text-white' : '' }}">
                                    {{ $page }}
                                </a>
                            </li>
                            @endforeach

                            {{-- Flecha Siguiente --}}
                            @if ($servicios->hasMorePages())
                            <li>
                                <a class="c tc wf xf wd in zc hn rg uj fo wk xm ml il hh rm tl zm yl an" href="{{ $servicios->nextPageUrl() }}">
                                    <svg class="th lm ml il" width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.06067 7.00001L0.110671 2.05001L1.52467 0.636014L7.88867 7.00001L1.52467 13.364L0.110672 11.95L5.06067 7.00001Z" />
                                    </svg>
                                </a>
                            </li>
                            @else
                            <li>
                                <span class="c tc wf xf wd in zc hn rg uj fo wk xm ml il hh rm tl zm yl an opacity-50 cursor-not-allowed">
                                    <svg class="th lm ml il" width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.06067 7.00001L0.110671 2.05001L1.52467 0.636014L7.88867 7.00001L1.52467 13.364L0.110672 11.95L5.06067 7.00001Z" />
                                    </svg>
                                </span>
                            </li>
                            @endif
                        </ul>
                    </nav>
                </div>

                <!-- Pagination -->
            </div>
        </section>
        <!-- ===== Blog Grid End ===== -->




        <!-- ===== CTA End ===== -->
    </main>
    <!-- ===== Footer Start ===== -->

    <x-client.navigation-footer />
    <!-- ===== Footer End ===== -->

    <!-- ====== Back To Top Start ===== -->
    <button
        class="xc wf xf ie ld vg sr gh tr g sa ta _a"
        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        @scroll.window="scrollTop = (window.pageYOffset > 50) ? true : false"
        :class="{ 'uc' : scrollTop }">
        <svg class="uh se qd" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
        </svg>
    </button>

    <!-- ====== Back To Top End ===== -->
    <script defer src="../assets/js/bundle.js"></script>
</body>

</html>