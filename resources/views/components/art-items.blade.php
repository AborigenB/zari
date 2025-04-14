@foreach ($arts as $art)
    {{-- 
12. Нажимая на кнопку со стрелочкой на карточке, ссылка копируется, и появляется текст "Ссылка скопирована".
13. Нажимая на кнопку с сердечком, оно меняет цвет: из серого становится красным и добавляется в избранное. Также можно удалить его из избранного, и сердце снова станет серым.
14. При заходе в каталог в цене есть кружочек: если на него не навести, он черный, а при наведении — зеленый или красный. Если кружок красный, на карточке появляется отметка "Продано", но зайти в карточку все равно можно, хотя купить уже нельзя. --}}
    <div class="group bg-white/20 border border-gray-200 rounded-[42px] p-3 overflow-hidden shadow-sm">
        <div class="relative aspect-w-1 aspect-h-1">
            <img src="{{ asset('storage/' . $art->images[0]->url) }}" alt="{{ $art->title }}" {{-- style="filter: grayscale(100%);" --}}
                class="w-full h-full max-h-[600px] object-cover transition duration-500 grayscale-100 group-hover:grayscale-0 rounded-[42px]">
            @if ($art->status == 'Продано')
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
                <a href="#" class="rounded-full p-2 bg-white flex">
                    <img src="{{ asset('assets/img/24037.svg') }}"
                        class="w-6 h-6 transition 
                        {{ $art->is_favorited ? 'invert-[25%] sepia-[51%] saturate-[2476%] hue-rotate-[346deg] brightness-[104%] contrast-[97%]' : '' }}">
                </a>
                <button onclick="navigator.clipboard.writeText('{{route('art.show', $art->id)}}')" class="rounded-full p-2 bg-white flex cursor-pointer">
                    <img src="{{ asset('assets/img/cartinerrow.png') }}" alt="">
                </button>
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


