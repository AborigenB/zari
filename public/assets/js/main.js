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

document.addEventListener('DOMContentLoaded', function () {
    const favoriteButtons = document.querySelectorAll('.favorite-button');

    favoriteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Предотвращаем стандартное поведение ссылки

            const artId = this.getAttribute('data-art-id');
            const heartIcon = this.querySelector('.heart-icon');

            fetch(`/art/${artId}/changeFavorite`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (data.isFavorite) {
                            heartIcon.setAttribute('fill','#B02F00')
                        } else {
                            heartIcon.setAttribute('fill','black')
                        }
                        showNotification(data.message, 'success');
                    } else {
                        showNotification('Произошла ошибка при изменении состояния избранного.', 'error');
                    }
                })
                .catch(error => {
                    showNotification('Произошла ошибка при изменении состояния избранного.', 'error');
                });
        });
    });
});

function showNotification(message, type) {
    const notificationContainer = document.createElement('div');
    notificationContainer.classList.add('notification', type);

    const notificationContent = document.createElement('div');
    notificationContent.classList.add('px-8', 'py-4', 'rounded-xl', 'text-white');
    notificationContent.textContent = message;

    notificationContainer.appendChild(notificationContent);
    document.body.appendChild(notificationContainer);

    setTimeout(() => {
        notificationContainer.classList.add('show');
    }, 10);

    setTimeout(() => {
        notificationContainer.classList.remove('show');
        setTimeout(() => {
            notificationContainer.remove();
        }, 300);
    }, 3000);
}

// кляксоризатор
document.addEventListener("DOMContentLoaded", function() {
    const imageContainer = document.getElementById('image-container');
    const images = [
        { src: window.location.protocol + "//" + window.location.host+"/assets/img/BlackKlyksa.png" },
        { src: window.location.protocol + "//" + window.location.host+"/assets/img/colorklaksa.png" },
        { src: window.location.protocol + "//" + window.location.host+"/assets/img/colorklaksa2.png" },
        { src: window.location.protocol + "//" + window.location.host+"/assets/img/colorklaksa3.png" },
        { src: window.location.protocol + "//" + window.location.host+"/assets/img/colorklaksa4.png" }
    ];
    function placeImages() {
        const fullHeight = document.documentElement.scrollHeight;
        const fullWidth = window.innerWidth;
        console.log(fullWidth)
        const numImages = Math.ceil(fullHeight / 1000); // Количество изображений зависит от высоты страницы

        imageContainer.innerHTML = ''; // Очистка предыдущих изображений

        for (let i = 0; i < numImages; i++) {
            const img = document.createElement('img');
            img.className = 'image-item';
            img.src = images[i % images.length].src;

            // Расчет случайных позиций
            const x = Math.random() * (fullWidth - 500);
            const y = Math.random() * (fullHeight - 500);

            img.style.left = `${x}px`;
            img.style.top = `${y}px`;

            imageContainer.appendChild(img);
        }
    }

    // Перерасположение изображений при изменении размера окна
    window.addEventListener('resize', placeImages);

    // Инициализация размещения изображений при загрузке страницы
    placeImages();
});