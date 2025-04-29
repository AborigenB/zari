document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('.cards');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const cards = Array.from(slider.querySelectorAll('.card'));
    let currentCardIndex = 0;

    // Инициализация активной карточки при загрузке
    if (cards.length > 0) {
        currentCardIndex = cards.findIndex(card => card.classList.contains('current'));
        if (currentCardIndex === -1) currentCardIndex = 0; // Если не указана, берем первую
    }

    // Функция для установки активной карточки
    const setActiveCard = (index) => {
        let previousIndex = index === 0 ? cards.length - 1 : index - 1;
        let currentIndex = index;
        let nextIndex = index === cards.length - 1 ? 0 : index + 1;

        // Очистка всех классов (включая "another")
        cards.forEach((card, i) => {
            card.classList.remove('current', 'previous', 'next', 'another');
        });

        // Присвоение классов
        cards[previousIndex]?.classList.add('previous');
        cards[currentIndex]?.classList.add('current');
        cards[nextIndex]?.classList.add('next');

        // Добавление класса "another" для оставшихся карточек
        cards.forEach(card => {
            if (
                !card.classList.contains('current') &&
                !card.classList.contains('previous') &&
                !card.classList.contains('next')
            ) {
                card.classList.add('another');
            }
        });

        currentCardIndex = currentIndex;
    };

    // Функция для обработки клика на кнопки
    const handleSetActive = (direction) => {
        let newIndex;
        if (direction === 'next') {
            newIndex = currentCardIndex + 1;
        } else {
            newIndex = currentCardIndex - 1;
        }

        // Проверка границ
        newIndex = newIndex % cards.length;
        if (newIndex < 0) newIndex = cards.length - 1;

        setActiveCard(newIndex);
    };

    // Инициализация начального состояния
    setActiveCard(currentCardIndex);

    // Обработчики событий
    nextBtn.addEventListener('click', () => handleSetActive('next'));
    prevBtn.addEventListener('click', () => handleSetActive('prev'));



    // Ссылка скопирована

});

function itCopied(event) {
    // Создание блока с классами 

    let block = document.querySelector('#urlCopied');
    block.classList.remove('hidden');
    block.style.top = `${event.pageY + 35}px`;
    block.style.left = `${event.pageX - 70}px`;

    // После 2 секунд добавляем стиль opacity-0, и через пол секунды добавляем hidden 
    setTimeout(() => {
        block.classList.add('opacity-0');
    }, 1000);
    setTimeout(() => {
        block.classList.add('hidden');
    }, 1500);
    setTimeout(() => {
        block.classList.remove('opacity-0');
    }, 2000);

    console.log(event)
}
