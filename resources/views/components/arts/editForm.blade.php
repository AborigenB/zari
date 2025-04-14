<form id="editForm" name="edit" method="POST" action="{{ route('art.update', $art->id) }}" enctype="multipart/form-data"
    class="relative mx-auto mt-28 mb-28 w-1/2 p-16 bg-white/25 border border-gray-300/47 shadow-[26px_34px_18.3px_rgba(0,0,0,0.25)] backdrop-blur-sm rounded-[50px]">
    @csrf
    @method('PUT')
    <!-- Заголовок формы -->
    <h2 class="text-center text-3xl font-medium text-black mt-[-30px] mb-16">Редактировать работу</h2>

    <!-- Поля формы -->
    <div class="flex flex-col gap-5 mt-20">

        <!-- Множественная загрузка изображений -->
        <div class="flex flex-col gap-2.5">
            <label for="images" class="text-xl font-normal text-black ml-[150px]">Загрузите изображения (jpg, jpeg,
                png, webp):</label>
            <input type="file" name="images[]" id="images" multiple
                class="mx-auto block text-center font-normal text-lg px-4 py-2.5 w-[600px] h-[55px] bg-[#fdf9f91e] border border-[#fdf9f9] rounded-full backdrop-blur-sm shadow-[0px_0px_18.3px_rgba(0,0,0,0.25)]">

            @error('images')
                {{ $message }}
            @enderror
        </div>

        <!-- Художник -->
        <div class="flex flex-col gap-2.5">
            <label for="artist" class="text-xl font-normal text-black ml-[150px]">Художник:</label>
            <input type="text" name="artist" id="artist" value="{{ old('artist', $art->artist) }}"
                class="mx-auto block text-center font-normal text-lg px-4 py-2.5 w-[600px] h-[55px] bg-[#fdf9f91e] border border-[#fdf9f9] rounded-full backdrop-blur-sm shadow-[0px_0px_18.3px_rgba(0,0,0,0.25)]">
            @error('artist')
                {{ $message }}
            @enderror
        </div>

        <!-- Название -->
        <div class="flex flex-col gap-2.5">
            <label for="title" class="text-xl font-normal text-black ml-[150px]">Название:</label>
            <input type="text" name="title" id="title" value="{{ old('title', $art->title) }}"
                class="mx-auto block text-center font-normal text-lg px-4 py-2.5 w-[600px] h-[55px] bg-[#fdf9f91e] border border-[#fdf9f9] rounded-full backdrop-blur-sm shadow-[0px_0px_18.3px_rgba(0,0,0,0.25)]">
            @error('title')
                {{ $message }}
            @enderror
        </div>

        <!-- Размер -->
        <div class="flex flex-col gap-2.5">
            <label for="size" class="text-xl font-normal text-black ml-[150px]">Размер:</label>
            <input type="text" name="size" id="size" value="{{ old('size', $art->size) }}"
                class="mx-auto block text-center font-normal text-lg px-4 py-2.5 w-[600px] h-[55px] bg-[#fdf9f91e] border border-[#fdf9f9] rounded-full backdrop-blur-sm shadow-[0px_0px_18.3px_rgba(0,0,0,0.25)]">
            @error('size')
                {{ $message }}
            @enderror
        </div>

        <!-- Выбор материалов -->
        <x-downselect name="material" :content="$materials" :selected="$art->materials->pluck('id')->toArray()">Материалы</x-downselect>

        <!-- Год -->
        <div class="flex flex-col gap-2.5">
            <label for="age" class="text-xl font-normal text-black ml-[150px]">Год:</label>
            <input type="number" name="age" id="age" value="{{ old('age', $art->age) }}"
                class="mx-auto block text-center font-normal text-lg px-4 py-2.5 w-[600px] h-[55px] bg-[#fdf9f91e] border border-[#fdf9f9] rounded-full backdrop-blur-sm shadow-[0px_0px_18.3px_rgba(0,0,0,0.25)]">
            @error('age')
                {{ $message }}
            @enderror
        </div>

        <!-- Выбор стилей -->
        <x-downselect name="style" :content="$styles" :selected="$art->styles->pluck('id')->toArray()">Стили</x-downselect>

        <!-- Выбор тегов -->
        <x-downselect name="tag" :content="$tags" :selected="$art->tags->pluck('id')->toArray()">Теги</x-downselect>

        <!-- Описание -->
        <div class="flex flex-col gap-2.5">
            <label for="description" class="text-xl font-normal text-black ml-[150px]">Описание:</label>
            <textarea name="description" id="description"
                class="mx-auto block font-normal text-lg px-5 py-5 w-[600px] h-[300px] bg-[#fdf9f91e] border border-[#fdf9f9] rounded-[50px] backdrop-blur-sm shadow-[0px_0px_18.3px_rgba(0,0,0,0.25)]">{{ old('description', $art->description) }}</textarea>
            @error('description')
                {{ $message }}
            @enderror
        </div>

        <!-- Цена -->
        <div class="flex flex-col gap-2.5">
            <label for="price" class="text-xl font-normal text-black ml-[150px]">Цена:</label>
            <input type="number" name="price" id="price" value="{{ old('price', $art->price) }}"
                class="mx-auto block text-center font-normal text-lg px-4 py-2.5 w-[600px] h-[55px] bg-[#fdf9f91e] border border-[#fdf9f9] rounded-full backdrop-blur-sm shadow-[0px_0px_18.3px_rgba(0,0,0,0.25)]">
            @error('price')
                {{ $message }}
            @enderror
        </div>

        <!-- Кнопка отправки -->
        <button type="submit"
            class="ml-[130px] mt-10 w-[440px] h-[60px] bg-[#B02F00] rounded-[50px] text-white text-xl font-medium hover:bg-[#992901] hover:scale-95 transition-transform duration-300 ease-in-out">
            Сохранить
        </button>
    </div>
</form>