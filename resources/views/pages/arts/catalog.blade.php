@extends('template.second')

@section('content')
    <div class="container mx-auto relative">
        <div
            class="ml-auto w-fit lg:w-[50%] flex lg:justify-between gap-4 lg:absolute -top-15 right-0 max-sm:flex-col max-sm:justify-center">
            <button class="font-montserrat text-[20px] flex items-center gap-2 p-2 w-fit" onclick="showFilter()">Показать
                фильтр
                <img class="w-[52px]" src="{{ asset('assets/img/Filter.png') }}" /></button>
            <form class="flex items-center gap-2 outline-0 focus:outline-0 w-fit" method="GET"
                action="{{ route('catalog') }}" id="price_sort_form">
                <label for="price_sort" class="text-[20px]">Сортировка</label>
                <select name="price_sort" id="price_sort" onchange="price_filter_change()">
                    <option value="" {{ request('price_sort') == '' ? 'selected' : '' }}>По умолчанию</option>
                    <option value="asc" {{ request('price_sort') == 'asc' ? 'selected' : '' }}>По возрастанию цены
                    </option>
                    <option value="desc" {{ request('price_sort') == 'desc' ? 'selected' : '' }}>По убыванию цены</option>
                </select>
            </form>
        </div>
        <!-- Форма фильтрации -->
        <div class="mb-8 hidden" id="filter">
            <form method="GET" action="{{ route('catalog') }}" class="space-y-6 flex flex-col">
                <div class="flex w-full gap-4 items-center justify-between max-md:flex-col">
                    <!-- Фильтр по цене -->
                    <div class="flex flex-col gap-2">
                        <label class="text-xl font-medium text-gray-700">
                            Цена:
                        </label>
                        <div class="flex gap-2 max-sm:flex-col">
                            <input type="number" name="min_price" placeholder="Минимальная цена"
                                class="w-full bg-white/20 border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="{{ request('min_price') }}">
                            <input type="number" name="max_price" placeholder="Максимальная цена"
                                class="w-full bg-white/20 border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="{{ request('max_price') }}">
                        </div>
                    </div>

                    <!-- Поиск по автору -->
                    <div class="flex flex-col gap-2">
                        <label for="author" class="block text-xl font-medium text-gray-700">
                            Автор:
                        </label>
                        <input type="text" name="author"
                            class="w-full bg-white/20 border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            value="{{ request('author') }}">
                    </div>

                    <!-- Фильтр по году -->
                    <div class="flex flex-col gap-2">
                        <label for="age" class="block text-xl font-medium text-gray-700">
                            Год:
                        </label>
                        <input type="text" name="age"
                            class="w-full bg-white/20 border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            value="{{ request('age') }}">
                    </div>
                </div>

                <div class="flex w-full gap-4 items-start justify-between">
                    <x-catalog.filter-select name="material" :content="$materials"
                        :selected="$selectedMaterials">Материалы</x-catalog.filter-select>
                    <x-catalog.filter-select name="style" :content="$styles"
                        :selected="$selectedStyles">Стили</x-catalog.filter-select>
                    <x-catalog.filter-select name="tag" :content="$tags"
                        :selected="$selectedTags">Теги</x-catalog.filter-select>
                </div>

                <div class="flex items-center gap-4 justify-end">
                    <button type="submit"
                        class="px-6 py-3 bg-[#B02F00] text-white hover:bg-[#b02f00e1] transition duration-200 rounded-[100px]" >
                        Искать
                    </button>
                    <a href="{{ route('catalog') }}"
                        class="text-black">
                        Сбросить
                    </a>
                </div>
            </form>
        </div>

        <!-- Сетка артов -->
        <div id="art-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 py-10">
            <x-art-items :$arts></x-art-items>
        </div>

        <div id="loading" class="text-center my-10 hidden">
            <p>Загрузка...</p>
        </div>
    </div>

    <script>
        let page = 1;
        let loading = false;

        function loadMoreArts() {
            if (loading) return;

            loading = true;
            document.getElementById('loading').classList.remove('hidden');

            const params = new URLSearchParams({
                page: page + 1,
                author: document.querySelector('input[name="author"]').value,
                materials: Array.from(document.querySelectorAll('input[name="material[]"]:checked')).map(el => el
                    .value),
                styles: Array.from(document.querySelectorAll('input[name="style[]"]:checked')).map(el => el.value),
                tags: Array.from(document.querySelectorAll('input[name="tag[]"]:checked')).map(el => el.value),
                min_price: document.querySelector('input[name="min_price"]').value,
                max_price: document.querySelector('input[name="max_price"]').value,
                age: document.querySelector('input[name="age"]').value,
                price_sort: document.querySelector('select[name="price_sort"]').value,
            });

            fetch(`{{ route('catalog') }}?${params.toString()}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                .then(response => response.text())
                .then(data => {
                    const artGrid = document.getElementById('art-grid');
                    artGrid.innerHTML += data;
                    page++;
                    loading = false;
                    document.getElementById('loading').classList.add('hidden');
                })
                .catch(error => {
                    console.error('Ошибка загрузки:', error);
                    loading = false;
                    document.getElementById('loading').classList.add('hidden');
                });
        }

        window.addEventListener('scroll', () => {
            const artGrid = document.getElementById('art-grid');
            if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight - 500)) {
                loadMoreArts();
            }
        });

        const filter = document.querySelector('#filter');

        function showFilter() {
            filter.classList.toggle('hidden');
        }

        const price_sort_form = document.querySelector('#price_sort_form');

        function price_filter_change() {
            price_sort_form.submit();
        }
    </script>
@endsection
