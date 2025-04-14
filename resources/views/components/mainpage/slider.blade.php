<div class="slider w-full overflow-hidden mx-auto px-10" id="slider">
    <h2 class="font-unbounded font-bold text-5xl tracking-[0.18em] text-[#B02F00] text-center mb-4">
        Новые работы
    </h2>

    <div class="cards w-fit max-sm:w-full mx-auto relative p-10 flex items-center gap-6 mt-4">
        @foreach ($arts as $index => $art)
            <div
                class="card max-sm:w-full transition
                    @if ($index === 0) current 
                    @elseif ($index === 1) next 
                    @elseif ($index === count($arts) - 1) previous 
                    @else another @endif
                    @if ($index !== 0) absolute @endif
                    p-5 px-8 bg-[rgba(255,255,255,0.3)] border-[0.854599px] border-[rgba(255,255,255,0.47)] 
                    shadow-[14.5282px_20.5104px_85.4599px_rgba(0,0,0,0.06)] backdrop-filter-blur-10 rounded-[42.73px] 
                    transform duration-300 ease-in-out">
                <div class="card__header relative">
                    {{-- {{dd($art->images[0]->url)}} --}}
                    <img class="imgcard w-[350px] rounded-[50px] transition-transform duration-300 ease-in-out filter grayscale-100 hover:grayscale-0"
                        src="{{ asset('storage/' . $art->images[0]->url) }}" alt="">
                    <a class="pereiti absolute top-[-74px] left-[280px] flex items-center justify-center w-[36px] h-[36px] bg-[#ffffff4d] 
                      backdrop-filter-blur-6 rounded-full transition-transform duration-300 ease-in-out hover:scale-1.1"
                        href="{{ route('art.show', ['id' => $art['id']]) }}">
                        <img src="/assets/img/cartinerrow.png" alt="">
                    </a>
                </div>
                <div class="card__medium mt-2 mb-4">
                    <h3 class="font-montserrat-black font-bold text-[32px] leading-[41px] text-[#3D2121] mb-2">
                        {{ $art['artist'] }}
                    </h3>
                    <p class="font-montserrat font-light text-[20px] leading-[28px] tracking-[0.18em] text-[#3D2121]">
                        {{ $art['title'] }}, {{ $art['size'] }}
                    </p>
                </div>
                <div
                    class="card__footer flex items-center justify-center gap-5 w-[200px] h-[40px] bg-[#b9b9b936] backdrop-filter-blur-6 rounded-full transition-transform duration-300 ease-in-out hover:scale-1.1">
                    <a href="#" class="flex items-center gap-20">
                        <div
                            class="w-[20px] h-[20px] bg-[#3D2121] rounded-full transition-transform duration-300 ease-in-out hover:scale-1.1 hover:bg-[#387028]">
                        </div>
                        <p
                            class="font-montserrat font-medium text-[18px] leading-[22px] tracking-[0.1em] text-[#3D2121]">
                            {{ $art['price'] }} руб
                        </p>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="arrow flex items-center justify-center gap-25 my-10">
        <button
            class="prev-btn flex items-center justify-center w-[183px] h-[82px] bg-[rgba(255,255,255,0.25)] border border-[rgba(255,255,255,0.47)] 
                       shadow-[17px_24px_16.3px_rgba(0,0,0,0.25)] backdrop-filter-blur-6 rounded-full">
            <img src="/assets/img/Left Arrow.png" alt="">
        </button>
        <button
            class="next-btn flex items-center justify-center w-[183px] h-[82px] bg-[rgba(255,255,255,0.25)] border border-[rgba(255,255,255,0.47)] 
                       shadow-[17px_24px_16.3px_rgba(0,0,0,0.25)] backdrop-filter-blur-6 rounded-full">
            <img src="/assets/img/Right Arrow.png" alt="">
        </button>
    </div>
</div>
