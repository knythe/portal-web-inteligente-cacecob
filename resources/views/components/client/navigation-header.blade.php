<header
    class="g s r vd ya cj"
    :class="{ 'hh sm _k dj bl ll' : stickyMenu }"
    @scroll.window="stickyMenu = (window.pageYOffset > 20) ? true : false">
    <div class="bb ze ki xn 2xl:ud-px-0 oo wf yf i">
        <div class="vd to/4 tc wf yf">
            <a href="index.html">
                <img class="om" src="/assets/img/logo.svg" alt="Logo Light" />
            </a>

            <!-- Hamburger Toggle BTN -->
            <button class="po rc" @click="navigationOpen = !navigationOpen">
                <span class="rc i pf re pd">
                    <span class="du-block h q vd yc">
                        <span class="rc i r s eh um tg te rd eb ml jl dl" :class="{ 'ue el': !navigationOpen }"></span>
                        <span class="rc i r s eh um tg te rd eb ml jl fl" :class="{ 'ue qr': !navigationOpen }"></span>
                        <span class="rc i r s eh um tg te rd eb ml jl gl" :class="{ 'ue hl': !navigationOpen }"></span>
                    </span>
                    <span class="du-block h q vd yc lf">
                        <span class="rc eh um tg ml jl el h na r ve yc" :class="{ 'sd dl': !navigationOpen }"></span>
                        <span class="rc eh um tg ml jl qr h s pa vd rd" :class="{ 'sd rr': !navigationOpen }"></span>
                    </span>
                </span>
            </button>
            <!-- Hamburger Toggle BTN -->
        </div>

        <div
            class="vd wo/4 sd qo f ho oo wf yf"
            :class="{ 'd hh rm sr td ud qg ug jc yh': navigationOpen }">
            <nav>
                <ul class="tc _o sf yo cg ep">
                    <li><a href="{{route('portal')}}" class="xl" :class="{ 'mk': page === 'home' }">Home</a></li>
                    <li class="c i" x-data="{ dropdown: false }">
                        <a
                            href="#"
                            class="xl tc wf yf bg"
                            @click.prevent="dropdown = !dropdown"
                            :class="{ 'mk': page === 'blog-grid' || page === 'blog-single' || page === 'signin' || page === 'signup' || page === '404' }">
                            Categories

                            <svg
                                :class="{ 'wh': dropdown }"
                                class="th mm we fd pf" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                            </svg>
                        </a>

                        <!-- Dropdown Start -->

                        <ul class="a" :class="{ 'tc': dropdown }">
                            <li><a href="{{route('seminarios')}}" class="xl" :class="{ 'mk': page === 'blog-grid' }">Seminarios</a></li>
                            <li><a href="{{route('diplomados')}}" class="xl" :class="{ 'mk': page === 'blog-grid' }">Diplomados</a></li>
                        </ul>
                        <!-- Dropdown End -->
                    </li>
                    <li><a href="index.html#support" class="xl">Contacto</a></li>
                </ul>
            </nav>

            <div class="tc wf ig pb no">
                <div>
                    <a>{{ Auth::user()->name }}</a>
                </div>
                <div class="c i" x-data="{ dropdown: false }">
                    <a href="#" class="xl tc wf yf bg flex items-center space-x-2"
                        @click.prevent="dropdown = !dropdown">
                        <img src="{{ Auth::user()->photo }}" alt="Avatar" class="w-6 h-6 rounded-full" />
                        <span x-text="user.name"></span>
                        <svg :class="{ 'wh': dropdown }" class="th mm we fd pf" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                        </svg>
                    </a>

                    <!-- Dropdown -->
                    <ul class="a" :class="{ 'tc': dropdown }">
                        <li><a href="account.html" class="xl">Cuenta</a></li>
                        <form method="POST" action="/logout">
                            @csrf
                            <button
                                type="submit"
                                :class="{ 'nk yl' : page === 'home', 'ok' : page === 'home' && stickyMenu }"
                                class="ek pk xl bg-transparent border-none cursor-pointer">
                                Cerrar sesión
                            </button>
                        </form>
                    </ul>
                </div>
                <div></div>

            </div>

        </div>
    </div>
</header>