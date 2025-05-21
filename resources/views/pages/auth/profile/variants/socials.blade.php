@extends('pages.auth.profile.index')
@section('profile-content')
    <div class="mt-4 flex flex-col">
        <h2 class="text-2xl font-bold mb-4">Социальные сети</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($socials as $social)
                <div class="group h-fit bg-white/20 border border-gray-200 rounded-[42px] p-3 overflow-hidden shadow-sm">
                    <div class="flex items-center space-x-4">
                        @if ($social->social === 'vk')
                            <a href="https://vk.com/{{ $social->link }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset('assets/img/VK.png') }}" alt="VK" class="w-12 h-12 rounded-full">
                            </a>
                        @elseif ($social->social === 'telegram')
                            <a href="https://t.me/{{ $social->link }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset('assets/img/Telegram.png') }}" alt="Telegram" class="w-12 h-12 rounded-full">
                            </a>
                        @elseif ($social->social === 'youtube')
                            <a href="https://www.youtube.com/{{ $social->link }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset('assets/img/Youtube.png') }}" alt="YouTube" class="w-12 h-12 rounded-full">
                            </a>
                        @endif
                        <div>
                            <p class="text-lg font-semibold">{{ strtoupper($social->social) }}</p>
                            <p class="text-gray-600">
                                <p href="#" target="_blank" rel="noopener noreferrer">
                                    {{ $social->link }}
                                </p>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($socials->isEmpty())
                <div class="group h-fit bg-white/20 border border-gray-200 rounded-[42px] p-3 overflow-hidden shadow-sm">
                    <p class="text-center text-gray-600">Социальных сетей нет</p>
                </div>
            @endif
        </div>
    </div>
@endsection