@extends('template.second')

@section('content')
    <div class="container mx-auto py-19 max-lg:py-4">
        <div class="flex gap-8 max-md:flex-col max-md:items-center">
            {{-- Слайдер с всеми изображениями --}}
            <div class="relative md:w-1/2" id="art_images_box">
                <!-- Главное изображение -->
                <div id="art_images_main" class="w-full h-96 overflow-hidden rounded-[50px]">
                    <img src="{{ asset('storage/' . $art->images[0]->url) }}" alt="" id="art_image_0"
                        class="w-full h-full object-cover transition-transform duration-500 transform">
                </div>

                <!-- Кнопки навигации -->
                <div class="absolute inset-y-1/2 flex items-center w-full justify-between px-4">
                    <button id="prevButton" class="text-gray-500 hover:text-gray-700 ml-2 bg-[#ffffff8f] rounded-full py-4 px-4 border border-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="nextButton" class="text-gray-500 hover:text-gray-700 mr-2 bg-[#ffffff8f] rounded-full py-4 px-4 border border-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <!-- Миниатюры изображений -->
                <div id="art_images_under"
                    class="mt-4 flex overflow-x-auto space-x-2 scrollbar-hide transition duration-300">
                    @foreach ($art->images as $index => $image)
                        <img src="{{ asset('storage/' . $image->url) }}" alt=""
                            class="w-52 h-35 object-cover rounded-[50px] cursor-pointer transition duration-300 ease-in-out opacity-75"
                            data-index="{{ $index }}">
                    @endforeach
                </div>
            </div>
            {{-- Характеристики товара --}}
            <div class="md:w-1/2 flex flex-col gap-8">
                <div class="flex flex-col gap-4">
                    <h2 class="font-montserrat text-4xl">{{ $art->user->login }}</h2>
                    <h2 class="font-noto-serif-kr text-2xl">{{ $art->title }}</h2>
                    <p class="font-noto-serif-kr text-2xl">Материалы: @foreach ($art->materials as $material)
                            {{ $material->name }},
                        @endforeach
                    </p>
                    <p class="font-noto-serif-kr text-2xl">Год: {{ $art->age }}</p>
                    <p class="font-noto-serif-kr text-2xl">Стили: @foreach ($art->styles as $style)
                            {{ $style->name }},
                        @endforeach
                    </p>
                </div>

                <div class="flex flex-col gap-4">
                    <p class="font-noto-serif-kr text-3xl">Цена: {{ $art->price }} ₽</p>
                    <a href="#"
                        class="w-fit font-nikyousans bg-[#3D2121] px-12 py-4 text-3xl font-light text-white rounded-[50px]">В
                        корзину</a>
                </div>
            </div>
        </div>

        {{-- Описание и тд --}}
        <div class="flex flex-col py-10 gap-10">
            <div class="">
                <h2 class="text-3xl font-noto-serif-kr">Описание: </h2>
                <p class="text-2xl font-noto-serif-kr">{{ $art->description }}</p>
            </div>
            {{-- Ревью --}}
            <div class="flex flex-col gap-5">
                <h2 class="text-3xl font-noto-serif-kr">Опубликовать рецензию:</h2>
                @error('score')
                    <p class="text-red-600">
                        {{ $message }}
                    </p>
                @enderror
                <div class="flex flex-col lg:gap-5 max-lg:gap-12">
                    <div class="flex max-lg:flex-col lg:gap-12 max-lg:gap-4 lg:items-center max-lg:items-start justify-between">
                        <label for="" class="text-2xl font-noto-serif-kr lg:w-1/2">Композиция и структура</label>
                        <div class="flex lg:items-center max-lg:items-start flex-wrap gap-3 lg:w-1/2" id="review_item">
                            @for ($i = 0; $i < 10; $i++)
                                <button class="w-12 h-12 bg-[#dddddd3b] cursor-pointer rounded-full"
                                    style="box-shadow: 2px 2px 3px 0"
                                    id="art_big_review_{{ $i }}">{{ $i + 1 }}</button>
                            @endfor
                        </div>
                    </div>
                    <div class="flex max-lg:flex-col lg:gap-12 max-lg:gap-4 lg:items-center max-lg:items-start justify-between">
                        <label for="" class="text-2xl font-noto-serif-kr lg:w-1/2">Цвет и свет</label>
                        <div class="flex lg:items-center max-lg:items-start flex-wrap gap-3 lg:w-1/2" id="review_item">
                            @for ($i = 0; $i < 10; $i++)
                                <button class="w-12 h-12 bg-[#dddddd3b] cursor-pointer rounded-full"
                                    style="box-shadow: 2px 2px 3px 0"
                                    id="art_big_review_{{ $i }}">{{ $i + 1 }}</button>
                            @endfor
                        </div>
                    </div>
                    <div class="flex max-lg:flex-col lg:gap-12 max-lg:gap-4 lg:items-center max-lg:items-start justify-between">
                        <label for="" class="text-2xl font-noto-serif-kr lg:w-1/2">Техника исполнения</label>
                        <div class="flex lg:items-center max-lg:items-start flex-wrap gap-3 lg:w-1/2" id="review_item">
                            @for ($i = 0; $i < 10; $i++)
                                <button class="w-12 h-12 bg-[#dddddd3b] cursor-pointer rounded-full"
                                    style="box-shadow: 2px 2px 3px 0"
                                    id="art_big_review_{{ $i }}">{{ $i + 1 }}</button>
                            @endfor
                        </div>
                    </div>
                    <div class="flex max-lg:flex-col lg:gap-12 max-lg:gap-4 lg:items-center max-lg:items-start justify-between">
                        <label for="" class="text-2xl font-noto-serif-kr lg:w-1/2">Тема и символизм</label>
                        <div class="flex lg:items-center max-lg:items-start flex-wrap gap-3 lg:w-1/2" id="review_item">
                            @for ($i = 0; $i < 10; $i++)
                                <button class="w-12 h-12 bg-[#dddddd3b] cursor-pointer rounded-full"
                                    style="box-shadow: 2px 2px 3px 0"
                                    id="art_big_review_{{ $i }}">{{ $i + 1 }}</button>
                            @endfor
                        </div>
                    </div>
                    <div class="flex max-lg:flex-col lg:gap-12 max-lg:gap-4 lg:items-center max-lg:items-start justify-between">
                        <label for="" class="text-2xl font-noto-serif-kr lg:w-1/2">Эмоциональное воздействие</label>
                        <div class="flex lg:items-center max-lg:items-start flex-wrap gap-3 lg:w-1/2" id="review_item">
                            @for ($i = 0; $i < 5; $i++)
                                <button class="w-12 h-12 bg-[#dddddd3b] cursor-pointer rounded-full"
                                    style="box-shadow: 2px 2px 3px 0"
                                    id="art_small_review_{{ $i }}">{{ $i + 1 }}</button>
                            @endfor
                        </div>
                    </div>
                    <div class="flex max-lg:flex-col lg:gap-12 max-lg:gap-4 lg:items-center max-lg:items-start justify-between">
                        <label for="" class="text-2xl font-noto-serif-kr lg:w-1/2">Оригинальность и
                            инновационность</label>
                        <div class="flex lg:items-center max-lg:items-start flex-wrap gap-3 lg:w-1/2" id="review_item">
                            @for ($i = 0; $i < 5; $i++)
                                <button class="w-12 h-12 bg-[#dddddd3b] cursor-pointer rounded-full"
                                    style="box-shadow: 2px 2px 3px 0"
                                    id="art_small_review_{{ $i }}">{{ $i + 1 }}</button>
                            @endfor
                        </div>
                    </div>
                </div>

                <form action="{{ route('art.review', $art->id) }}" method="post" class="flex flex-col gap-10">
                    @csrf
                    <div class="flex flex-col gap-5">
                        <div class="flex flex-col">
                            @error('title')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                            <input type="text" name="title" class="bg-[#ffffff28] px-8 py-4 rounded-2xl"
                                placeholder="Заголовок (до 120 символов)">
                        </div>
                        <div class="flex flex-col">
                            @error('description')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                            <textarea name="description" class="bg-[#ffffff28] px-8 py-4 rounded-2xl"
                                placeholder="Текст рецензии (от 30 до 8500 символов)"></textarea>
                        </div>
                    </div>
                    <div class="hidden">
                        <input type="text" name="score[]" id="score" hidden>
                        <input type="text" name="score[]" id="score" hidden>
                        <input type="text" name="score[]" id="score" hidden>
                        <input type="text" name="score[]" id="score" hidden>
                        <input type="text" name="score[]" id="score" hidden>
                        <input type="text" name="score[]" id="score" hidden>
                    </div>
                    <div class="flex gap-10 ml-auto items-center">
                        <div class="flex gap-3">
                            <p class="font-noto-serif-kr text-8xl" id="totalScore">0</p>

                            <p class="font-noto-serif-kr text-5xl">/ 50</p>
                        </div>
                        <button class="cursor-pointer" type="submit"><img
                                src="{{ asset('assets/img/markSubmit.svg') }}" alt=""></button>
                    </div>
                </form>
            </div>

            <div class="flex flex-col gap-10">
                <div class="flex justify-between items-center">
                    <h2 class="text-3xl font-noto-serif-kr">Рецензии пользователей</h2>
                    <div class="flex gap-12">
                        <button class="bg-[#ffffff05] px-6 py-4 rounded-full text-2xl" style='box-shadow: 0px 0px 18.3px rgba(0, 0, 0, 0.25);' id="review_prev"><</button>
                        <button class="bg-[#ffffff05] px-6 py-4 rounded-full text-2xl" style='box-shadow: 0px 0px 18.3px rgba(0, 0, 0, 0.25);' id="review_next">></button>
                    </div>
                </div>
                
                <div class="flex flex-col" id="review_scroller">
                    @forelse ($art->reviews as $index => $review)
                        <div class="@if ($index == 0) flex @else hidden @endif flex-col gap-13 bg-[#ffffff23] py-8 px-12 rounded-3xl" style="box-shadow: 14.5282px 20.5104px 85.4599px rgba(0, 0, 0, 0.06)">
                            <div class="flex justify-between max-md:flex-col">
                                <div class="flex gap-5 items-center max-sm:flex-col">
                                    <div class="w-24 h-24">
                                        <img class="object-cover w-full h-full rounded-full" src="{{ asset('storage/' . $review->user->images[0]->url) }}"
                                            alt="">
                                    </div>
                                    <div class="flex flex-col gap-5">
                                        <h2 class="font-noto-serif-kr text-3xl">{{ $review->user->login }}</h2>
                                        <p class="font-noto-serif-kr text-2xl">{{ $review->updated_at }}</p>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h2 class="font-noto-serif-kr text-7xl md:ml-auto max-md:mr-auto">{{ $review->getTotalScoreAttribute() }}</h2>
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
                                <h2 class="font-noto-serif-kr text-3xl">{{ $review->title }}</h2>
                                <p class="font-noto-serif-kr text-2xl"> {{ $review->description }} </p>
                            </div>
                        </div>
                    @empty
                        Отзывов нет
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/review.js') }}" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainImage = document.getElementById('art_images_main').querySelector('img');
            const miniature_overflow = document.querySelector('#art_images_under');
            const miniatures = document.querySelectorAll('#art_images_under img');
            const prevButton = document.getElementById('prevButton');
            const nextButton = document.getElementById('nextButton');

            let currentIndex = 0;

            // Функция для установки текущего изображения
            function setCurrentImage(index) {
                currentIndex = index;
                mainImage.src = miniatures[currentIndex].src;
                mainImage.alt = miniatures[currentIndex].alt;

                // Подсветка текущей миниатюры
                miniatures.forEach((miniature, idx) => {
                    miniature.classList.toggle('opacity-100', idx === currentIndex);
                });
            }

            // Обработчик кликов по миниатюрам
            miniatures.forEach((miniature, index) => {
                miniature.addEventListener('click', () => {
                    setCurrentImage(index);
                });
            });

            // Обработчик кнопок "Предыдущее" и "Следующее"
            prevButton.addEventListener('click', () => {
                if (currentIndex > 0) {
                    setCurrentImage(currentIndex - 1);
                }
                miniature_overflow.scrollBy({
                    left: -miniatures[0].offsetWidth
                })
            });

            nextButton.addEventListener('click', () => {
                if (currentIndex < miniatures.length - 1) {
                    setCurrentImage(currentIndex + 1);
                }
                miniature_overflow.scrollBy({
                    left: miniatures[0].offsetWidth
                })
            });

            // Инициализация
            setCurrentImage(0);

            const reviewsSlider = document.querySelector('#review_scroller');
            console.log(reviewsSlider.children.length)
            let index = 0;

            document.querySelector('#review_prev').addEventListener('click', ()=>{
                if(index > 0){
                    changeReview(index-=1)
                }
            })
            document.querySelector('#review_next').addEventListener('click', ()=>{
                if(index < reviewsSlider.children.length-1){
                    changeReview(index+=1)
                }
            })

            function changeReview(index){
                [...reviewsSlider.children].forEach((slide, slideIndex)=>{
                    slide.classList.remove('flex');
                    slide.classList.add('hidden');
                    if(slideIndex == index){
                        slide.classList.add('flex');
                        slide.classList.remove('hidden');
                    }
                })
            }
        });
    </script>
@endsection
