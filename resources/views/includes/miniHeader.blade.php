<header class="w-full pb-25 relative"
    style="background:url({{ asset('assets/img/header.png') }}) no-repeat center; background-size: cover;">
    {{-- <div class="absolute z-10 p-5 w-full h-full">
        <div class="w-full h-full rounded-[100px]"
            style="background:url({{ asset('assets/img/header.png') }}) no-repeat; background-size: cover;"></div>
        {{-- <img class="min-h-[96vh] rounded-3xl object-cover" src="" alt=""> --}}
    {{-- </div> --}}

    <div class="relative z-100 p-5 flex flex-col justify-between h-full">
        <div class="flex py-4 px-5 justify-between items-center container mx-auto">
            <div class="flex items-center justify-center w-32 h-32 rounded-full bg-[#fdf9f9]">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
            </div>

            <div
                class="max-md:hidden nav flex justify-around items-center text-center rounded-full w-[997px] h-[92px] bg-[#fdf9f9]">
                <a class="btn__nav text-[20px] font-montserrat text-black" href="{{route('home')}}">Главная</a>
                <a class="btn__nav text-[20px] font-montserrat text-black px-4 p-2 rounded-full {{ Route::is('catalog')? 'bg-[#3D2121] text-white': ''}}" href="{{route('catalog')}}">Каталог</a>
                <a class="btn__nav text-[20px] font-montserrat text-black px-4 p-2 rounded-full {{ Route::is('painters')? 'bg-[#3D2121] text-white': ''}}" href="{{route('painters')}}">Художники</a>
                @if (auth()->check())
                    <a class="btn__nav__img font-montserrat" href="{{ route('profile.show', auth()->user()->id) }}">
                        <img src="{{asset('assets/img/account.png')}}" alt="">
                    </a>
                @else
                    <a class="btn__nav__img font-montserrat" href="{{ route('login') }}">
                        <img src="{{asset('assets/img/account.png')}}" alt="">
                    </a>
                @endif
            </div>

            <div class="md:hidden">
                <button>
                    <img src="{{ asset('assets/img/burger.svg') }}" alt="burger">
                </button>
            </div>
        </div>


        {{-- <div class="flex justify-center ml-auto w-[50%] relative p-10 rounded-tl-[50px] bg-[var(--main-bg-color)]">
            <div
                class="max-lg:hidden absolute w-[50px] h-[50px] -left-[50px] -bottom-0 bg-[radial-gradient(at_top_left,_rgba(204,0,0,0)_49px,_var(--main-bg-color)_51px)]">
            </div>
            <div
                class="max-lg:hidden absolute w-[50px] h-[50px] -top-[50px] -right-[0px] bg-[radial-gradient(at_top_left,_rgba(204,0,0,0)_49px,_var(--main-bg-color)_50px)]">
            </div>
        </div> --}}
    </div>
</header>
