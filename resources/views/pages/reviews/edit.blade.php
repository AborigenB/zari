@extends('template.second')

@section('content')
    <div class="container mx-auto my-10">
        <div class="">
            <h2 class="text-2xl font-noto-serif-kr">Рецензия на
                <a href="{{ route('art.show', $review->art->id) }}">
                    {{ $review->art->title }}
                </a>
            </h2>
        </div>
    </div>
    <div class="container mx-auto my-10">
        @error('score')
            <p class="text-red-600">
                {{ $message }}
            </p>
        @enderror
        <div class="flex flex-col gap-5">
            <div class="flex gap-12 items-center justify-between">
                <label for="" class="text-2xl font-noto-serif-kr w-1/2">Композиция и структура</label>
                {{-- {{dd($review)}} --}}
                <div class="flex items-center gap-3 w-1/2" id="review_item">
                    @for ($i = 0; $i < 10; $i++)
                        <button class="w-12 h-12 bg-[#dddddd3b] cursor-pointer rounded-full"
                            style="box-shadow: 2px 2px 3px 0"
                            id="art_big_review_{{ $i }}">{{ $i + 1 }}</button>
                    @endfor
                </div>
            </div>
            <div class="flex gap-12 items-center justify-between">
                <label for="" class="text-2xl font-noto-serif-kr w-1/2">Цвет и свет</label>
                <div class="flex items-center gap-3 w-1/2" id="review_item">
                    @for ($i = 0; $i < 10; $i++)
                        <button class="w-12 h-12 bg-[#dddddd3b] cursor-pointer rounded-full"
                            style="box-shadow: 2px 2px 3px 0"
                            id="art_big_review_{{ $i }}">{{ $i + 1 }}</button>
                    @endfor
                </div>
            </div>
            <div class="flex gap-12 items-center justify-between">
                <label for="" class="text-2xl font-noto-serif-kr w-1/2">Техника исполнения</label>
                <div class="flex items-center gap-3 w-1/2" id="review_item">
                    @for ($i = 0; $i < 10; $i++)
                        <button class="w-12 h-12 bg-[#dddddd3b] cursor-pointer rounded-full"
                            style="box-shadow: 2px 2px 3px 0"
                            id="art_big_review_{{ $i }}">{{ $i + 1 }}</button>
                    @endfor
                </div>
            </div>
            <div class="flex gap-12 items-center justify-between">
                <label for="" class="text-2xl font-noto-serif-kr w-1/2">Тема и символизм</label>
                <div class="flex items-center gap-3 w-1/2" id="review_item">
                    @for ($i = 0; $i < 10; $i++)
                        <button class="w-12 h-12 bg-[#dddddd3b] cursor-pointer rounded-full"
                            style="box-shadow: 2px 2px 3px 0"
                            id="art_big_review_{{ $i }}">{{ $i + 1 }}</button>
                    @endfor
                </div>
            </div>
            <div class="flex gap-12 items-center justify-between">
                <label for="" class="text-2xl font-noto-serif-kr w-1/2">Эмоциональное воздействие</label>
                <div class="flex items-center gap-3 w-1/2" id="review_item">
                    @for ($i = 0; $i < 5; $i++)
                        <button class="w-12 h-12 bg-[#dddddd3b] cursor-pointer rounded-full"
                            style="box-shadow: 2px 2px 3px 0"
                            id="art_small_review_{{ $i }}">{{ $i + 1 }}</button>
                    @endfor
                </div>
            </div>
            <div class="flex gap-12 items-center justify-between">
                <label for="" class="text-2xl font-noto-serif-kr w-1/2">Оригинальность и
                    инновационность</label>
                <div class="flex items-center gap-3 w-1/2" id="review_item">
                    @for ($i = 0; $i < 5; $i++)
                        <button class="w-12 h-12 bg-[#dddddd3b] cursor-pointer rounded-full"
                            style="box-shadow: 2px 2px 3px 0"
                            id="art_small_review_{{ $i }}">{{ $i + 1 }}</button>
                    @endfor
                </div>
            </div>
        </div>
        <form action="{{ route('review.update', $review->id) }}" method="post" class="flex flex-col gap-10 mt-5">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-5">
                <div class="flex flex-col">
                    @error('title')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <input type="text" name="title" class="bg-[#ffffff28] px-8 py-4 rounded-2xl"
                        placeholder="Заголовок (до 120 символов)" value="{{ $review->title }}">
                </div>
                <div class="flex flex-col">
                    @error('description')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <textarea name="description" class="bg-[#ffffff28] px-8 py-4 rounded-2xl"
                        placeholder="Текст рецензии (от 30 до 8500 символов)">{{ $review->description }}</textarea>
                </div>
            </div>
            <div class="hidden">
                <input type="text" name="score[]" value="{{ $review->score1 }}" id="score" hidden>
                <input type="text" name="score[]" value="{{ $review->score2 }}" id="score" hidden>
                <input type="text" name="score[]" value="{{ $review->score3 }}" id="score" hidden>
                <input type="text" name="score[]" value="{{ $review->score4 }}" id="score" hidden>
                <input type="text" name="score[]" value="{{ $review->score5 }}" id="score" hidden>
                <input type="text" name="score[]" value="{{ $review->score6 }}" id="score" hidden>
            </div>
            <div class="flex gap-10 ml-auto items-center">
                <div class="flex gap-3">
                    <p class="font-noto-serif-kr text-8xl" id="totalScore">0</p>

                    <p class="font-noto-serif-kr text-5xl">/ 50</p>
                </div>
                <button class="cursor-pointer" type="submit"><img src="{{ asset('assets/img/markSubmit.svg') }}"
                        alt=""></button>
            </div>
        </form>
    </div>
    <script src="{{ asset('assets/js/reviewUpdate.js') }}" defer></script>
    <script>
        const reviewItems = document.querySelectorAll('#review_item')
        const reviewBigButtons = document.querySelectorAll('#art_big_review')
        const reviewSmallButtons = document.querySelectorAll('#art_small_review')
        const reviewColors = ['bg-[#dc3545]', 'bg-[#ffa500]', 'bg-[#28a745]', 'bg-[#ffd700]']
        const bigReviewBgRules = [reviewColors[0], reviewColors[0], reviewColors[0], reviewColors[1], reviewColors[1],
            reviewColors[1], reviewColors[2], reviewColors[2], reviewColors[2], reviewColors[3]
        ]
        const smallReviewBgRules = [reviewColors[0], reviewColors[0], reviewColors[1], reviewColors[2], reviewColors[3]]
        const scoreInputs = document.querySelectorAll('#score');
        const totalScore = document.querySelector('#totalScore')
        totalScore.innerHTML = {{ $review->getTotalScoreAttribute() }}

        const scoreInputsOld = document.querySelectorAll('input[name="score[]"]');



        reviewItems.forEach((item, index) => {

            [...item.children].forEach((btn, btnIndex) => {
                btn.addEventListener('click', (event) => {
                    let selectedBtn = item.querySelector('.selected');
                    if (selectedBtn) {
                        selectedBtn.classList.remove(bigReviewBgRules[selectedBtn.innerHTML - 1],
                            smallReviewBgRules[selectedBtn.innerHTML - 1])
                        selectedBtn.classList.add('text-black');
                        selectedBtn.classList.remove('selected')
                        selectedBtn.classList.remove('text-white')
                    }

                    btn.classList.remove('bg-[#dddddd3b]');
                    btn.classList.remove('text-black');
                    if (index == 4 || index == 5) {
                        btn.classList.add(smallReviewBgRules[btnIndex]);
                    } else {
                        btn.classList.add(bigReviewBgRules[btnIndex]);
                    }
                    btn.classList.add('text-white')
                    btn.classList.add('selected');

                    scoreInputs[index].value = `${btnIndex + 1}`;
                    // console.log(scoreInputs[index].value)

                    updateScore()
                })
            })
        })

        function updateScore() {
            let total = 0;
            scoreInputs.forEach((input) => {
                total += +input.value
            })
            totalScore.innerHTML = total;
        }

        function initialize() {
            scoreInputsOld.forEach((input, index) => {
                const value = parseInt(input.value);
                if (!isNaN(value)) {
                    let requiredBtn;
                    if (index < 4) {
                        requiredBtn = reviewItems[index].querySelector(`#art_big_review_${value-1}`);
                    } else {
                        requiredBtn = reviewItems[index].querySelector(`#art_small_review_${value-1}`);
                    }
                    requiredBtn.click();
                    console.log(requiredBtn);
                }
            });
        }

        initialize()
    </script>
@endsection
