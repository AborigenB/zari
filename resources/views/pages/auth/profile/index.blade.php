@extends('template.second')

@section('content')
    <div class="container flex flex-col gap-4 mx-auto my-20">
        <div class="">
            <div class="w-full">
                <img src="{{ asset('storage/' . $user->profileBgImage()) }}" class="w-full h-140 rounded-4xl object-cover"
                    alt="Фон профиля">
            </div>
            <div class="flex relative">
                {{-- <div class="relative w-80"> --}}
                <div class="absolute -top-20 left-10 xl:left-20">
                    <img class="w-40 h-40 object-cover rounded-full border border-white"
                        src="{{ asset('storage/' . $user->profileImage()) }}" alt="Фото профиля">
                </div>
                {{-- </div> --}}

                <div
                    class="flex ml-auto w-[80%] max-md:w-[60%] relative max-sm:ml-0 max-sm:w-[100%] max-sm:mt-20 max-sm:justify-center">
                    <div class="flex flex-col mt-4">
                        <h2 class="font-montserrat text-3xl">{{ $user->login }}</h2>
                        <p class="font-montserrat">{{ $user->description }}</p>
                    </div>

                    @if (auth()->user()->id == $user->id)
                        {{-- модалка настроек --}}
                        <div class="absolute -top-10 right-0 max-sm:-top-30">
                            <div class="relative">
                                <button onclick="openSettings()" class="p-3 bg-[#ffffff70] rounded-full">
                                    <img class='w-12' src="{{ asset('assets/img/Settings.png') }}" alt="">
                                </button>
                                <div id="settings" class="absolute hidden right-0">
                                    <div class="flex flex-col w-max bg-[#ffffff70] p-4 rounded-2xl">
                                        <a href="{{ route('profile.edit', $user->id) }}">Редактировать профиль</a>
                                        <a href="{{ route('profile.editData', $user->id) }}">Редактирование учетной
                                            записи</a>
                                        @if ($user->role == 'admin')
                                            <a href="{{ route('admin') }}">Войти в админку</a>
                                        @endif
                                        <a href="{{ route('logout') }}">Выход из профиля</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="w-full shadow-xl px-5 py-2.5 rounded-2xl flex gap-8 bg-[#ffffff28] items-center">
            @if (auth()->user()->id == $user->id)
                <a href="{{ route('profile.show', auth()->user()->id) }}" class="font-noto-serif-kr text-xl">Мои работы</a>
            @else
                <a href="{{ route('profile.show', $user->id) }}" class="font-noto-serif-kr text-xl">Работы</a>
            @endif
            <a href="{{ route('profile.favorite', $user->id) }}" class="font-noto-serif-kr text-xl">Избранное</a>
            <a href="{{ route('profile.review', $user->id) }}" class="font-noto-serif-kr text-xl">Рецензии</a>
            {{-- <a href="{{route('profile.chats', $user->id)}}" class="font-noto-serif-kr text-xl">Чаты</a> --}}
            @if (auth()->user()->id != $user->id)
                <a href="{{ route('profile.chat', $user->id) }}" class="ml-auto bg-[#B02F00] rounded-4xl px-8 py-2">
                    <img class="h-12" src="{{ asset('assets/img/Speech Bubble.svg') }}" alt="">
                </a>
            @endif

        </div>
        @yield('profile-content')
    </div>

    <script>
        function openSettings() {
            document.getElementById('settings').classList.toggle('hidden');
        }
    </script>
@endsection
