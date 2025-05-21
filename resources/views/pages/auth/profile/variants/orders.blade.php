@extends('pages.auth.profile.index')
@section('profile-content')
    <div class="mt-4 flex flex-col">
        <h2 class="text-2xl font-bold mb-4">Мои заказы</h2>
        @if ($orders->isEmpty())
            <div class="group h-fit bg-white/20 border border-gray-200 rounded-[42px] p-3 overflow-hidden shadow-sm">
                <p class="text-center text-gray-600">Заказов нет</p>
            </div>
        @else
            @foreach ($orders as $order)
                <div
                    class="group h-fit bg-white/20 border border-gray-200 rounded-[42px] p-3 overflow-hidden shadow-sm mb-4">
                    <div class="flex flex-col gap-4">
                        <h3 class="text-xl font-semibold">Заказ №{{ $order->id }}</h3>
                        <p class="text-gray-500">Статус: {{ $order->status }}</p>
                        <p class="text-gray-500">Дата: {{ $order->created_at->format('d.m.Y H:i') }}</p>
                        <p class="text-gray-500">Общая сумма: {{ $order->total_price }} ₽</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($order->orderItems as $orderItem)
                                <div
                                    class="group h-fit bg-white/20 border border-gray-200 rounded-[42px] p-3 overflow-hidden shadow-sm">
                                    <div class="relative aspect-w-1 aspect-h-1">
                                        <img src="{{ asset('storage/' . $orderItem->art->images[0]->url) }}"
                                            alt="{{ $orderItem->art->title }}"
                                            class="w-full h-full max-h-[500px] object-cover transition duration-500 grayscale-100 group-hover:grayscale-0 rounded-[42px]">
                                        @if ($orderItem->art->status == 'Продано')
                                            <div
                                                class="absolute z-10 top-2 left-2 bg-[rgba(255,255,255,0.3)]
                                            border-[0.854599px]
                                            border-[rgba(255,255,255,0.47)]
                                            shadow-[14.5282px_20.5104px_85.4599px_rgba(0,0,0,0.06)]
                                            backdrop-blur-[10px]
                                            rounded-[42.73px]
                                            px-3 py-1.5">
                                                <p class="text-white font-montserrat">Продано</p>
                                            </div>
                                        @endif
                                        <div class="absolute bottom-4 right-4 flex gap-2">
                                            <a href="{{ route('art.show', $orderItem->art->id) }}"
                                                class="rounded-full p-2 bg-white flex cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="25"
                                                    viewBox="0 0 31 29" fill="none">
                                                    <path
                                                        d="M22.5 0C18.5 0 15.5 3.5 15.5 3.5C15.5 3.5 12 0 8.5 0C5 0 0 1.5 0 8.5C0 15.5 12.5 28.5 15.5 28.5C18.5 28.5 31 15 31 8.5C31 2 26.5 0 22.5 0Z"
                                                        fill="black" class="hover:fill-[red] duration-500" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold mb-2">
                                            {{ $orderItem->art->artist }}
                                        </h3>
                                        <p class="text-gray-500 mb-4">
                                            {{ $orderItem->art->title }}, {{ $orderItem->art->size }}
                                        </p>
                                        <a href="{{ route('art.show', $orderItem->art->id) }}"
                                            class="flex items-center gap-2 text-red-600 hover:text-red-700 transition">
                                            <span
                                                class="w-4 h-4 rounded-full grayscale-100 group-hover:grayscale-0 transition duration-500 bg-black {{ $orderItem->art->status == 'Продано' ? 'group-hover:bg-red-800' : 'group-hover:bg-green-500' }}">
                                            </span>
                                            <span class="text-xl font-medium ml-1">
                                                {{ $orderItem->art->price }}
                                            </span>
                                            <span class="text-2xl">₽</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
