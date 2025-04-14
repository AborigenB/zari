<div class="flex flex-col gap-2.5 w-full">
    <label for="{{ $name }}s" class="text-xl font-normal text-black">{{ $slot }}:</label>
    @error('{{ $name }}s')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    <div class="relative" id="multiSelect{{ ucfirst($name) }}">
        <!-- Отображение выбранных элементов -->
        <div class="border rounded px-2 py-4 cursor-pointer" onclick="toggleDropdown{{ ucfirst($name) }}()">
            <div class="flex flex-wrap gap-2" id="selected{{ ucfirst($name) }}"></div>
            <input type="text" readonly placeholder="Выберите {{ strtolower($slot) }}"
                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
        </div>

        <!-- Выпадающий список -->
        <div id="{{ $name }}Dropdown"
            class="absolute z-10 w-full mt-1 border rounded bg-white max-h-60 overflow-auto hidden">
            <input type="text" placeholder="Поиск..." id="{{ $name }}Search" class="w-full p-2 mb-2">
            <div class="flex flex-wrap">
                @foreach ($content as $object)
                    <div class="flex items-center p-2 hover:bg-gray-100 cursor-pointer {{ $name }}-item"
                        onclick="handleClick{{ ucfirst($name) }}(event, {{ $object['id'] }})">
                        <input type="checkbox" class="mr-2" id="{{ $name }}_{{ $object['id'] }}">
                        <p id="{{ $name }}ListItem">{{ $object['name'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Скрытые поля для отправки -->
        <div id="hiddenInputs{{ $name }}"></div>
    </div>

    <script>
        const selected{{ $name }} = @json(old($name . 's', $selected));
        const {{ $name }}s = {!! json_encode($content) !!};

        function toggleDropdown{{ ucfirst($name) }}() {
            const dropdown = document.getElementById('{{ $name }}Dropdown');
            dropdown.classList.toggle('hidden');
            
        }

        function handleClick{{ ucfirst($name) }}(event, id) {
            event.stopPropagation(); // Предотвращаем всплытие события
            const checkbox = document.getElementById('{{ $name }}_' + id);
            checkbox.checked = !checkbox.checked; // Инвертируем состояние чекбокса
            toggle{{ ucfirst($name) }}(id);
        }

        function toggle{{ ucfirst($name) }}(id) {
            const checkbox = document.getElementById('{{ $name }}_' + id);
            if (checkbox.checked) {
                if (!selected{{ $name }}.includes(''+id)) {
                    selected{{ $name }}.push(''+id);
                }
            } else {
                const index = selected{{ $name }}.indexOf(''+id);
                if (index !== -1) {
                    selected{{ $name }}.splice(index, 1);
                }
            }

            update{{ ucfirst($name) }}();
        }

        function update{{ ucfirst($name) }}() {
            const container = document.getElementById('selected' + '{{ ucfirst($name) }}');
            const hiddenContainer = document.getElementById('hiddenInputs' + '{{ $name }}');
            container.innerHTML = '';
            hiddenContainer.innerHTML = '';

            selected{{ $name }}.forEach(id => {
                const numericId = parseInt(id, 10);
                const {{ $name }} = {{ $name }}s.find(m => m.id === numericId);
                if ({{ $name }}) {
                    const tagItem = document.createElement('span');
                    tagItem.className = 'bg-blue-100 text-blue-800 px-2 py-1 rounded flex items-center';
                    tagItem.textContent = {{ $name }}.name;

                    container.appendChild(tagItem);

                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = '{{ $name . 's' }}[]';
                    input.value = numericId;
                    hiddenContainer.appendChild(input);
                } else {
                    console.warn(`Элемент с ID ${numericId} не найден в контенте`);
                }
            });
        }

        // Инициализация чекбоксов при загрузке
        function initialize{{ ucfirst($name) }}() {

            selected{{ $name }}.forEach(id => {
                const numericId = parseInt(id, 10);
                const checkbox = document.getElementById('{{ $name }}_' + numericId);
                if (checkbox) {
                    checkbox.checked = true;
                } else {
                    console.warn(`Checkbox для ID ${numericId} не найден в DOM`);
                }
            });

            update{{ ucfirst($name) }}();
        }

        initialize{{ ucfirst($name) }}();

        // Добавление обработчика для поиска
        document.getElementById('{{ $name }}Search').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const items = document.querySelectorAll('#{{ $name }}Dropdown .{{ $name }}-item');
            items.forEach(item => {
                let listItem = item.querySelector('#{{ $name }}ListItem').textContent
            .toLowerCase();
                item.style.display = listItem.includes(query) ? '' : 'none';
            });
        });

        // Закрытие при клике вне
        document.addEventListener('click', (e) => {
            const dropdown = document.getElementById('{{ $name }}Dropdown');
            const multiSelect = document.getElementById('multiSelect{{ ucfirst($name) }}');
            if (!multiSelect.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</div>
