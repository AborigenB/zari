@extends('template.second')

@section('content')
    <div class="container mx-auto md:-mt-15">
        <div class="bg-[#ffffff25] ml-auto flex gap-12 items-center px-4 py-2 w-max rounded-[50px] border border-[#ffffff50] backdrop-blur-sm"
            style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
            <a href="" class="text-2xl font-montserrat">← Назад</a>
            <div class="flex gap-4 items-center">
                <div class="flex flex-col gap-2">
                    <h2 class="text-2xl font-montserrat">{{ $user->login }}</h2>
                    <p class="font-montserrat">В сети не в сети</p>
                </div>
                <img class="object-cover w-16 h-16 rounded-full" src="{{ asset('storage/' . $user->profileImage()) }}"
                    alt="">

            </div>
        </div>
    </div>
    <div class="container mx-auto py-18">
        <div class="bg-[#ffffff25] rounded-[50px] py-8 border border-[#ffffff50] backdrop-blur-sm"
            style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
            <div class="py-4 px-8 overflow-y-scroll max-h-screen setScrollBar flex flex-col gap-3" id="messages">
                @foreach ($messages as $message)
                    @if ($message->sender_id == auth()->user()->id)
                        <div class="bg-[#FF590025] px-4 py-2 ml-auto w-max rounded-[50px] border border-[#ffffff50] backdrop-blur-sm"
                            style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                            <p class="font-montserrat text-xl">
                                {{ $message->content }}
                            </p>
                        </div>
                    @else
                        <div class="bg-[#ffffff25] px-4 py-2 w-max rounded-[50px] border border-[#ffffff50] backdrop-blur-sm"
                            style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                            <p class="font-montserrat text-xl">
                                {{ $message->content }}
                            </p>
                        </div>
                    @endif
                @endforeach
            </div>

            <form class="flex px-8 justify-between items-center gap-4" id="message_form">
                <input id="message-input" type="text"
                    class="bg-[#ffffff25] outline-0 px-8 py-4 w-full rounded-[50px] backdrop-blur-sm border border-[#ffffff50]"
                    style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" name="message" placeholder="Сообщение">
                <button class="bg-[#B02F00] py-4 px-12 rounded-[50px] text-white" type="submit">Отправить</button>
            </form>
        </div>
    </div>
    <script defer>
        document.getElementById('message_form').addEventListener('submit', function(event) {
            event.preventDefault();
            const messageInput = document.getElementById('message-input');
            const content = messageInput.value.trim();

            if (content === '') {
                return;
            }

            fetch('{{ route('message.send', $user->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        receiver_id: {{ $user->id }},
                        content: content
                    })
                })
                .then(response => response.json())
                .then(message => {
                    const messagesContainer = document.getElementById('messages');
                    const block = document.createElement('div');
                    const p = document.createElement('p');

                    // Добавляем классы отдельно
                    block.classList.add('bg-[#FF590025]', 'ml-auto', 'px-4', 'py-2', 'w-max', 'rounded-[50px]',
                        'border',
                        'border-[#ffffff50]', 'backdrop-blur-sm');
                    p.classList.add('font-montserrat', 'text-xl');

                    p.innerText = message.content;
                    block.appendChild(p);
                    messagesContainer.appendChild(block);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight; // Прокрутка вниз
                    messageInput.value = ''; // Очистить поле ввода
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
