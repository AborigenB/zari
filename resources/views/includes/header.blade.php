<header class="w-full h-screen relative">
    <div class="absolute z-10 p-5 w-full h-full">
        <div class="w-full h-full rounded-[100px]"
            style="background:url({{ asset('assets/img/headerbg2.png') }}) no-repeat; background-size: cover;"></div>
        {{-- <img class="min-h-[96vh] rounded-3xl object-cover" src="" alt=""> --}}
    </div>

    <div class="relative z-100 p-5 flex flex-col justify-between h-full">
        <div class="flex py-4 px-5 justify-between items-center container mx-auto">
            <div class="flex items-center justify-center w-32 h-32 rounded-full bg-[#fdf9f9]">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
            </div>

            <div class="max-md:hidden nav flex justify-around items-center text-center rounded-full w-[997px] h-[92px] bg-[#fdf9f9]">
                <a class="btn__nav text-[20px] font-montserrat text-black px-4 p-2 rounded-full {{ Route::is('home')? 'bg-[#3D2121] text-white': ''}}" href="{{route('home')}}">Главная</a>
                <a class="btn__nav text-[20px] font-montserrat text-black px-4 p-2 rounded-full {{ Route::is('catalog')? 'bg-[#3D2121] text-white': ''}}" href="{{route('catalog')}}">Каталог</a>
                <a class="btn__nav text-[20px] font-montserrat text-black px-4 p-2 rounded-full {{ Route::is('painters')? 'bg-[#3D2121] text-white': ''}}" href="{{route('painters')}}">Художники</a>
                @if (auth()->check())
                    <a class="btn__nav__img font-montserrat px-4 p-2 rounded-full {{ Route::is('profile.show')? 'bg-[#3D2121] text-white': ''}}" href="{{route('profile.show', auth()->user()->id)}}">
                        <img src="assets/img/account.png" alt="">
                    </a>
                @else
                    <a class="btn__nav__img font-montserrat px-4 p-2 rounded-full {{ Route::is('login')? 'bg-[#3D2121] text-white': ''}}" href="{{route('login')}}">
                        <img src="assets/img/account.png" alt="">
                    </a>
                @endif
            </div>

            <div class="md:hidden">
                <button>
                    <img src="{{asset('assets/img/burger.svg')}}" alt="burger">
                </button>
            </div>
        </div>

        <div
            class="max-xl:hidden absolute -right-1/12 max-xl:-right-2/12 top-3/12 flex gap-4 w-max items-center rotate-90 origin-bottom-left ">
            <p class="text-white text-2xl">Подписывайся</p>
            <div class="flex gap-4">
                <a class="h-12 -rotate-90" href="https://vk.com/?u=2&to=L2FsX2ZlZWQucGhw"><img class="h-12"
                        src="/assets/img/VK.png"></a>
                <a class="h-12 object-cover -rotate-90" href="https://web.telegram.org/"><img class="h-12"
                        src="/assets/img/Telegram.png" alt=""></a>
            </div>
        </div>

        <div class="flex flex-col gap-4 w-full">
            <div
                class="2xl:hidden relative mx-auto">
                <h1 class="w-fit pr-10 text-center text-5xl max-sm:text-3xl font-unbouded text-white tracking-[0.57em] animate-fade-in-from-left">
                    ЗАРЯ</h1>
                <p class="w-fit pl-10 font-unbouded text-center text-white tracking-[0.57em] text-5xl max-sm:text-3xl animate-fade-in-from-right">ГАЛЕРЕЯ</p>
                {{-- <div
                    class="max-md:hidden absolute w-[100px] h-[100px] -top-[100px] bg-[radial-gradient(at_top_right,_rgba(204,0,0,0)_99px,_var(--main-bg-color)_100px)]">
                </div>
                <div
                    class="max-md:hidden absolute w-[100px] h-[100px] -bottom-[100px] bg-[radial-gradient(at_bottom_right,_rgba(204,0,0,0)_99px,_var(--main-bg-color)_100px)]">
                </div> --}}
            </div>

            <div class="xl:hidden flex gap-4 w-max items-center mx-auto">
                <p class="text-white text-2xl">Подписывайся</p>
                <div class="flex gap-4">
                    <a class="h-12" href="https://vk.com/?u=2&to=L2FsX2ZlZWQucGhw"><img class="h-12"
                            src="/assets/img/VK.png"></a>
                    <a class="h-12 object-cover" href="https://web.telegram.org/"><img class="h-12"
                            src="/assets/img/Telegram.png" alt=""></a>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-10 max-2xl:hidden">
            <h1 class="pl-10 text-8xl font-unbouded text-white tracking-[0.57em] animate-fade-in-from-left">ЗАРЯ</h1>

            <div class="flex justify-between">
                <h2
                    class="relative max-2xl:hidden w-4/12 font-montserrat font-extrabold text-4xl leading-tight tracking-widest text-[#3D2121] bg-[var(--main-bg-color)] rounded-tr-[98px] rounded-bl-[100px]">
                    <span class="p-12 flex">ВАШЕ ТВОРЧЕСТВО СИЯЕТ НА РАССВЕТЕ</span>
                    <div
                        class="absolute w-[100px] h-[100px] -top-[100px] bg-[radial-gradient(at_top_right,_rgba(204,0,0,0)_99px,_var(--main-bg-color)_100px)]">
                    </div>
                    <div
                        class="absolute w-[100px] h-[100px] -right-[100px] bottom-0 bg-[radial-gradient(at_top_right,_rgba(204,0,0,0)_99px,_var(--main-bg-color)_100px)]">
                    </div>
                </h2>
                <div class="max-2xl:hidden mx-auto flex flex-col justify-center gap-8 pb-10">
                    <h1 class="text-8xl font-unbouded text-white tracking-[0.57em] animate-fade-in-from-right">ГАЛЕРЕЯ</h1>
                    <nav class="flex gap-2 justify-between">
                        <x-navlink href='' value="О нас" />
                        <x-navlink href='' value="Новые работы" />
                        <x-navlink href='' value="Частые вопросы" />
                        <x-navlink href='' value="Поддержка" />
                    </nav>
                </div>
            </div>
        </div>

        <div class="2xl:hidden flex justify-center relative max-md:mx-auto p-10 lg:rounded-tl-[50px]">
            <nav class="flex max-md:flex-col gap-10">
                <x-navlink href='' value="О нас" />
                <x-navlink href='' value="Новые работы" />
                <x-navlink href='' value="Частые вопросы" />
                <x-navlink href='' value="Поддержка" />
            </nav>
{{-- 
            <div
                class="2xl:hidden max-lg:hidden absolute w-[50px] h-[50px] -left-[50px] -bottom-0 bg-[radial-gradient(at_top_left,_rgba(204,0,0,0)_49px,_var(--main-bg-color)_51px)]">
            </div>
            <div
                class="2xl:hidden max-lg:hidden absolute w-[50px] h-[50px] -top-[50px] -right-[0px] bg-[radial-gradient(at_top_left,_rgba(204,0,0,0)_49px,_var(--main-bg-color)_50px)]">
            </div> --}}
        </div>
    </div>
</header>
