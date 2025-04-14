<div class="group question container mx-auto" id="question">
    <h2 class="text-6xl font-extrabold text-orange-800 mb-20 font-unbounded leading-normal tracking-wider">
        Частые вопросы
    </h2>

    <div class="question__item flex justify-between items-center">
        <div class="faq flex flex-col gap-10 z-10 xl:w-[70%]">
            <!-- FAQ Items -->
            <div
                class="faq__item font-montserrat bg-white/12 border border-orange-600 rounded-full p-8 transition-shadow duration-300 
                backdrop-blur-md shadow-[2px_2px_10px_2px_rgba(0,0,0,0.06)]">
                <h3 class="text-2xl font-semibold mb-4 flex items-center justify-between">
                    Есть ли комиссия за продажу работ на сайте?
                    <span class="plus-icon text-orange-600">+</span>
                </h3>
                <p class="overflow-hidden transition-max-h duration-300 max-h-0">
                    Нет, комиссия за продажу работ на сайте не взимается. Вы получаете полную сумму от продажи без
                    дополнительных сборов.
                </p>
            </div>

            <div
                class="faq__item font-montserrat bg-white/12 border border-orange-600 rounded-full p-8 transition-shadow duration-300 
                backdrop-blur-md shadow-[2px_2px_10px_2px_rgba(0,0,0,0.06)]">
                <h3 class="text-2xl font-semibold mb-4 flex items-center justify-between">
                    Как связаться с другими художниками на сайте?
                    <span class="plus-icon text-orange-600">+</span>
                </h3>
                <p class="overflow-hidden transition-max-h duration-300 max-h-0">
                    Чтобы связаться с другими художниками на сайте, вы можете зайти в их профиль. В профиле вы найдете
                    контактные данные, которые позволят вам установить связь с художником.
                </p>
            </div>

            <div
                class="faq__item font-montserrat bg-white/12 border border-orange-600 rounded-full p-8 transition-shadow duration-300 
                backdrop-blur-md shadow-[2px_2px_10px_2px_rgba(0,0,0,0.06)]">
                <h3 class="text-2xl font-semibold mb-4 flex items-center justify-between">
                    Можно ли добавлять, теги и другую инфу к работам?
                    <span class="plus-icon text-orange-600">+</span>
                </h3>
                <p class="overflow-hidden transition-max-h duration-300 max-h-0">
                    Да, вы можете добавлять теги и другую информацию к своим работам. Это поможет улучшить видимость
                    ваших работ и упростит поиск для потенциальных покупателей.
                </p>
            </div>

            <div
                class="faq__item font-montserrat bg-white/12 border border-orange-600 rounded-full p-8 transition-shadow duration-300 
                backdrop-blur-md shadow-[2px_2px_10px_2px_rgba(0,0,0,0.06)]">
                <h3 class="text-2xl font-semibold mb-4 flex items-center justify-between">
                    С кем можно связаться в случае тех.вопросов?
                    <span class="plus-icon text-orange-600">+</span>
                </h3>
                <p class="overflow-hidden transition-max-h duration-300 max-h-0">
                    В случае технических вопросов вы можете обратиться к контактной информации, которая указана ниже.
                    Там вы найдете все необходимые данные для связи и сможете задать свой вопрос.
                </p>
            </div>

            <!-- Добавьте остальные FAQ-элементы аналогично -->
        </div>

        <div class="question__img -ml-[20%] max-md:hidden">
            <img src="/assets/img/photo_2024-09-20_23-00-33 1.png"
                class="grayscale transition-all duration-500 group-hover:grayscale-0" alt="FAQ Image">
        </div>
    </div>
</div>


<script>
    document.querySelector('.faq').addEventListener('click', function(event) {
        const target = event.target.closest('.faq__item');
        if (!target) return;

        // Toggle active state
        target.classList.toggle('active');
        const content = target.querySelector('p');

        // Toggle content visibility
        if (target.classList.contains('active')) {
            content.style.maxHeight = content.scrollHeight + 'px';
            content.style.paddingBottom = '20px'; // Add spacing for content
        } else {
            content.style.maxHeight = null;
            content.style.paddingBottom = null;
        }
    });
</script>