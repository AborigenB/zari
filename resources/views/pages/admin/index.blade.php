@extends('template.admin')

@section('content')
    <div class="flex-1">
        <div class="flex gap-4">
            {{-- <div class="w-3/12"></div> --}}
            <div class="sticky top-0 left-0 z-10 h-full min-h-screen w-3/12"
                style="background:url('{{ asset('assets/img/adminfon.jpg') }}');">
                <div class="h-full py-12 min-h-screen flex flex-col gap-8 items-center backdrop-blur-sm w-[90%]"
                    style="box-shadow: 0px 4px 19px rgba(0, 0, 0, 0.25)">
                    <div class="flex flex-col items-center gap-2">
                        <h2 class="text-white text-6xl tracking-[0.93em] font-montseratblack">ЗАРЯ</h2>
                        <p class="text-white font-montserrat">Добро пожаловать, Администратор!</p>
                    </div>

                    <div class="flex flex-col items-start gap-8">
                        <div class="flex flex-col items-start gap-3">
                            <button
                                class="tab-btn flex gap-2 items-center transition duration-300 text-white scale-90 font-montserrat rounded"
                                data-tab="users">
                                <img class="w-8 h-8 object-cover" src="{{ asset('assets/img/Users.png') }}" alt="">
                                Пользователи
                            </button>
                            <button
                                class="tab-btn flex gap-2 items-center transition duration-300 text-white font-montserrat rounded"
                                data-tab="works">
                                <img class="w-8 h-8 object-cover" src="{{ asset('assets/img/Picture.png') }}"
                                    alt="">
                                Публикации
                            </button>
                            <button
                                class="tab-btn flex gap-2 items-center transition duration-300 text-white font-montserrat rounded"
                                data-tab="reviews">
                                <img class="w-8 h-8 object-cover" src="{{ asset('assets/img/Popular.png') }}"
                                    alt="">
                                Рецензии
                            </button>
                        </div>

                        <div class="flex flex-col items-start">
                            <a class="flex gap-2 items-center text-white font-montserrat" href="{{ route('logout') }}">
                                <img class="w-8 h-8 object-cover" src="{{ asset('assets/img/Logout.png') }}" alt="">
                                Выйти из аккаунта</a>
                            <a class="flex gap-2 items-center text-white font-montserrat"
                                href="{{ route('profile.show', auth()->user()->id) }}">
                                <img class="w-8 h-8 object-cover" src="{{ asset('assets/img/U Turn to Left.png') }}"
                                    alt="">
                                Вернуться в профиль</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-9/12 py-12 px-8">
                <!-- Users Tab -->
                <div class="tab-pane active" id="users">
                    <div class="grid grid-cols-1 gap-4">
                        @foreach ($users as $user)
                            @if ($user->role != 'admin')
                                <div class="bg-[#ffffff25] flex gap-12 justify-between items-center px-4 py-2 rounded-[50px] border border-[#ffffff50] backdrop-blur-sm"
                                    style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <img class="w-16 h-16 rounded-full object-cover"
                                        src="{{ asset('storage/' . $user->profileImage()) }}" alt="{{ $user->login }}">
                                    <p class="font-montserrat">{{ $user->login }}</p>
                                    @if ($user->role != 'banned' && $user->role != 'admin')
                                        <a href="{{route('admin.ban', $user->id)}}" class="text-red-500 font-montserrat">Забанить</a>
                                    @elseif ($user->role != 'admin' && $user->role == 'banned')
                                        <a href="{{route('admin.unban', $user->id)}}" class="text-green-500 font-montserrat">Разблокировать</a>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Works Tab -->
                <div class="tab-pane hidden" id="works">
                    <div class="grid grid-cols-4 gap-5 mt-5">
                        @foreach ($arts as $art)
                            <div
                                class="group relative bg-white/20 border border-gray-200 rounded-[42px] p-3 overflow-hidden shadow-sm">
                                <div class="relative aspect-w-1 aspect-h-1">
                                    <img src="{{ asset('storage/' . $art->images[0]->url) }}" alt="{{ $art->title }}"
                                        {{-- style="filter: grayscale(100%);" --}}
                                        class="w-full h-full max-h-[600px] object-cover transition duration-500 grayscale-100 group-hover:grayscale-0 rounded-[42px]">
                                    @if ($art->status == 'Продано')
                                        <div
                                            class="absolute z-10 top-2 left-2 bg-[rgba(255,255,255,0.3)] border-[0.854599px] border-[rgba(255,255,255,0.47)] shadow-[14.5282px_20.5104px_85.4599px_rgba(0,0,0,0.06)] backdrop-blur-[10px] rounded-[42.73px] px-3 py-1.5">
                                            <p class="text-white font-montserrat">Продано</p>
                                        </div>
                                    @endif

                                    <div class="absolute flex gap-4 top-3 right-3">
                                        <a class="bg-[#ffffff4d] backdrop-blur-sm flex items-center justify-center p-4 rounded-full"
                                            href="{{ route('art.edit', $art->id) }}">
                                            <img class="w-8 h-8" src="{{ asset('assets/img/svg/edit.svg') }}"
                                                alt="">
                                        </a>
                                        <a class="bg-[#ffffff4d] backdrop-blur-sm flex items-center justify-center p-4 rounded-full"
                                            href="{{ route('art.destroy', $art->id) }}">
                                            <img class="w-8 h-8" src="{{ asset('assets/img/svg/delete.svg') }}"
                                                alt="">
                                        </a>
                                    </div>

                                </div>

                                <div class="p-4">

                                    <h3 class="text-lg font-semibold mb-2">
                                        {{ $art->artist }}
                                    </h3>
                                    <p class="text-gray-500 mb-4">
                                        {{ $art->title }}, {{ $art->size }}
                                    </p>

                                    <a href="{{ route('art.show', $art->id) }}"
                                        class="flex items-center gap-2 text-red-600 hover:text-red-700 transition">
                                        <span
                                            class="w-4 h-4 rounded-full grayscale-100 group-hover:grayscale-0 transition duration-500 bg-black {{ $art->status == 'Продано' ? 'group-hover:bg-red-800' : 'group-hover:bg-green-500' }}">
                                        </span>
                                        <span class="text-xl font-medium ml-1">
                                            {{ $art->price }}
                                        </span>

                                        <span class="text-2xl">₽</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div class="tab-pane hidden" id="reviews">
                    {{-- <div class="bg-white shadow-lg rounded-lg p-10 mt-5"> --}}
                        <div class="flex flex-col gap-5">

                            @forelse ($reviews as $review)
                                <div class="flex flex-col gap-13 bg-[#ffffff23] py-8 px-12 rounded-3xl relative"
                                    style="box-shadow: 14.5282px 20.5104px 85.4599px rgba(0, 0, 0, 0.06)">
                                    <div class="absolute flex gap-4 bottom-6 right-6">
                                        <a class="bg-[#ffffff4d] backdrop-blur-sm flex items-center justify-center p-4 rounded-full"
                                            href="{{ route('review.edit', $review->id) }}">
                                            <img class="w-8 h-8" src="{{ asset('assets/img/svg/edit.svg') }}" alt="">
                                        </a>
                                        <a class="bg-[#ffffff4d] backdrop-blur-sm flex items-center justify-center p-4 rounded-full"
                                            href="{{ route('review.delete', $review->id) }}">
                                            <img class="w-8 h-8" src="{{ asset('assets/img/svg/delete.svg') }}" alt="">
                                        </a>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="flex gap-5 items-center">
                                            <div class="w-24 h-24">
                                                <img class="object-cover w-full h-full rounded-full"
                                                    src="{{ asset('storage/' . $review->user->images[0]->url) }}"
                                                    alt="">
                                            </div>
                                            <div class="flex flex-col gap-5">
                                                <h2 class="font-noto-serif-kr text-3xl">{{ $review->user->login }}</h2>
                                                <p class="font-noto-serif-kr text-2xl">{{ $review->updated_at }}</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <h2 class="font-noto-serif-kr text-7xl ml-auto">
                                                {{ $review->getTotalScoreAttribute() }}</h2>
                                            <div class="flex gap-4">
                                                <p class="font-noto-serif-kr text-xl">{{ $review->score1 }}</p>
                                                <p class="font-noto-serif-kr text-xl">{{ $review->score2 }}</p>
                                                <p class="font-noto-serif-kr text-xl">{{ $review->score3 }}</p>
                                                <p class="font-noto-serif-kr text-xl">{{ $review->score4 }}</p>
                                                <p class="font-noto-serif-kr text-xl">{{ $review->score5 }}</p>
                                                <p class="font-noto-serif-kr text-xl">{{ $review->score6 }}</p>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="flex flex-col gap-8">
                                        <h2 class="font-noto-serif-kr text-xl">Рецензия на: <a class="underline"
                                                href="{{ route('art.show', $review->art->id) }}">{{ $review->art->title }}</a>
                                        </h2>
                                        <h2 class="font-noto-serif-kr text-3xl">{{ $review->title }}</h2>
                                        <p class="font-noto-serif-kr text-2xl max-w-full break-words"> {{ $review->description }} </p>
                                    </div>
                                </div>
                            @empty
                                Отзывов нет
                            @endforelse
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tabButtons = document.querySelectorAll('.tab-btn');
                const tabPanes = document.querySelectorAll('.tab-pane');

                tabButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        const targetTab = this.getAttribute('data-tab');

                        tabButtons.forEach(function(btn) {
                            btn.classList.toggle('scale-90', btn === this);
                        }, this);

                        tabPanes.forEach(function(pane) {
                            pane.classList.toggle('hidden', pane.id !== targetTab);
                        });
                    });
                });
            });
        </script>
    </div>
@endsection
