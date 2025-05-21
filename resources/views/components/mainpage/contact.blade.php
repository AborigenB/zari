<div class="contact mx-auto relative pb-20 md:pb-40">
    <h2 class="text-6xl font-extrabold text-orange-800 mb-10 font-unbounded leading-normal tracking-wider text-center">
        Контакты
    </h2>

    <div class="relative py-20 flex flex-col items-center overflow-hidden">

        <div
            class="contact__item relative z-10 bg-white/25 border border-white/40 rounded-[100px] p-10 md:p-20 
            shadow-[26px_34px_18.3px_rgba(0,0,0,0.25)] 
            backdrop-blur-md 
            flex flex-col gap-10 md:gap-20 
            mx-auto max-w-[80%]">

            <!-- Контактная информация -->
            <div class="contact__soccetis flex-1 flex flex-col gap-8 items-center">
                <div class="contact__socceti flex items-center gap-4">
                    <h3 class="text-2xl font-black text-orange-800">Email: </h3>
                    <p class="text-2xl text-orange-800 font-montserrat">info@zarya.com</p>
                </div>
                <div class="contact__socceti flex items-center gap-4">
                    <h3 class="text-2xl font-black text-orange-800">Telegram: </h3>
                    <p class="text-2xl text-orange-800 font-montserrat">ZaryaGallery</p>
                </div>
                <div class="contact__socceti flex items-center gap-4">
                    <h3 class="text-2xl font-black text-orange-800">Instagram: </h3>
                    <p class="text-2xl text-orange-800 font-montserrat">ZaryaArt</p>
                </div>
            </div>

            <!-- Текст -->
            <div class="contact__text flex-1 text-center text-gray-700 text-2xl font-montserrat">
                Если у вас остались вопросы, вы можете оставить свои данные и мы свяжемся с вами в ближайшее время или
                напишите нам в Telegram
            </div>

            <!-- Форма -->
            <form class="contact__form flex-1 flex flex-col gap-6" action="{{ route('send.question') }}"
                id="contactForm" method="POST">
                @csrf
                <input
                    class="contact__form__inp px-6 py-4 text-center text-2xl 
                        bg-white/10 border border-white/20 rounded-full 
                        shadow-[26px_34px_18.3px_rgba(0,0,0,0.25)] 
                        backdrop-blur-md 
                        placeholder:text-gray-400 
                        focus:outline-none focus:border-orange-600 transition"
                    type="text" name="contact_info" placeholder="Telegram/Email" required />

                <input
                    class="contact__form__inp px-6 py-4 text-center text-2xl 
                        bg-white/10 border border-white/20 rounded-full 
                        shadow-[26px_34px_18.3px_rgba(0,0,0,0.25)] 
                        backdrop-blur-md 
                        placeholder:text-gray-400 
                        focus:outline-none focus:border-orange-600 transition"
                    type="text" name="question" placeholder="Вопрос" required />

                <button
                    class="contact__form__btn px-6 py-4 text-center text-white text-2xl 
                        bg-orange-800 border border-orange-800/50 rounded-full 
                        shadow-[26px_34px_18.3px_rgba(0,0,0,0.25)] 
                        backdrop-blur-md 
                        transition duration-300 hover:bg-orange-700 hover:scale-95"
                    type="submit">Отправить</button>
            </form>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('contactForm');
                    const responseMessage = document.getElementById('responseMessage');

                    form.addEventListener('submit', function(event) {
                        event.preventDefault(); // Предотвращаем стандартное поведение формы

                        const formData = new FormData(form);

                        fetch('{{ route('send.question') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.message) {
                                    responseMessage.innerHTML = `<p class="px-8 py-4 rounded-xl bg-green-700 text-white transition duration-300">${data.message}</p>`;
                                    // устанавливаем класс hidden через 3 секунды
                                    responseMessage.classList.remove('hidden');
                                    setTimeout(() => {
                                        responseMessage.classList.add('hidden');
                                    }, 3000);

                                    form.reset(); // Очищаем форму после успешной отправки
                                }
                            })
                            .catch(error => {
                                console.error('Ошибка:', error);
                                responseMessage.innerHTML =
                                    `<p class="px-8 py-4 rounded-xl bg-red-700 text-white">Произошла ошибка при отправке формы.</p>`;
                            });
                    });
                });
            </script>
        </div>

        <!-- Фоновые изображения -->

        <div class="contact__fon absolute top-0 bottom-0 flex justify-between w-full">
            <!-- Левое изображение -->
            <div class="contact-img-1">
                <img class="max-w-[700px] absolute left-0 h-full 
                    contact-image transition-transform duration-2000 ease-out"
                    src="/assets/img/Group 15.png" style="transform: translateX(-100%);" alt="">
            </div>

            <!-- Правое изображение -->
            <div class="contact-img-2">
                <img class="max-w-[700px] absolute right-0 h-full 
                    contact-image transition-transform duration-2000 ease-out"
                    src="/assets/img/Group 16.png" style="transform: translateX(100%);" alt="">
            </div>
        </div>
    </div>

</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Инициализируем наблюдение за родительским контейнером контактов
        const contactContainer = document.querySelector('.contact');

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Запускаем анимацию для обоих изображений
                    document.querySelectorAll('.contact-image').forEach(img => {
                        img.style.transform = 'translateX(0)';
                    });

                    // Останавливаем наблюдение, чтобы анимация сработала один раз
                    observer.unobserve(entry.target);
                }
            });
        }, {
            // Анимация запускается, когда контейнер контактов на 50% видим
            // rootMargin: '0px 0px -50% 0px',
            threshold: 0.5 // Теперь срабатывает при 50% видимости контейнера
        });

        // Наблюдаем за контейнером контактов, а не за изображениями
        observer.observe(contactContainer);
    });
</script>
