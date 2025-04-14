@extends('template.second')

@section('content')
{{-- {{dd($social_vk->link)}} --}}
    <div class="container mx-auto flex flex-col gap-5 items-center my-10 max-md:px-4">
        <div class="w-full relative">
            <label for="backgroundImageInput" class="w-full">
                <img id="backgroundImage"
                src="{{ asset('storage/' . (auth()->user()->images()->where('position', 'фон')->first()->url ?? 'default.jpg')) }}"
                alt="Background Image" class="w-full h-70 rounded-4xl object-cover">
            </label>
            <input hidden type="file" name="background_image" id="backgroundImageInput" accept="image/*"
            onchange="changeImg()">
            
            <div class="w-24 absolute -bottom-15 left-20">
                <label for="profileImageInput" class="w-full flex justify-center items-center">
                    <img id="profileImage"
                        src="{{ asset('storage/' . (auth()->user()->images()->where('position', 'профиль')->first()->url ?? 'default.jpg')) }}"
                        alt="Profile Image" class="w-24 h-24 rounded-full object-cover border-[#ffffff50] border">
                        <img src="{{asset('assets/img/camera.png')}}" alt="" class="absolute w-16">
                </label>
                <input hidden type="file" name="profile_image" id="profileImageInput" accept="image/*" onchange="changeImg()">
            </div>
        </div>

        <form action="{{ route('profile.update') }}" method="post" class="w-[50%] max-md:w-full max-md:mt-12">
            @csrf
            <div class="flex flex-col gap-4">
                <div class="">
                    <label for="">Никнейм</label>
                    <input class="w-full py-2 px-4 rounded-xl border border-[#b6b6b6] shadow bg-[#ffffff44] backdrop-blur-lg" type="text" name="login" value="{{Auth::user()->login}}">
                </div>
                <div class="">
                    <label for="description">Описание:</label>
                    <textarea class="w-full py-2 px-4 rounded-xl border border-[#b6b6b6] shadow bg-[#ffffff44] backdrop-blur-lg" name="description" id="description">{{ Auth::user()->description }}</textarea>
                </div>

                <div class="w-full py-2 px-4 rounded-xl border border-[#b6b6b6] shadow bg-[#ffffff44] backdrop-blur-lg">
                    <label for="" class="flex gap-4 items-center">
                        <img src="{{asset('assets/img/VK com.png')}}" class="w-12" alt="">
                        <p>Vkontakte</p>
                    </label>
                    <input type="text" name="social_vk" placeholder="Вставьте ссылку" value="{{$social_vk->link??''}}" class="w-full py-2 px-4 rounded-xl border border-[#b6b6b6] shadow bg-[#ffffff44] backdrop-blur-lg">
                </div>
                
                <div class="w-full py-2 px-4 rounded-xl border border-[#b6b6b6] shadow bg-[#ffffff44] backdrop-blur-lg">
                    <label for="" class="flex gap-4 items-center">
                        <img src="{{asset('assets/img/Telegram App.png')}}" class="w-12" alt="">
                        <p>Telegram</p>
                    </label>
                    <input type="text" name="social_tg" placeholder="Вставьте ссылку" value="{{$social_tg->link??''}}" class="w-full py-2 px-4 rounded-xl border border-[#b6b6b6] shadow bg-[#ffffff44] backdrop-blur-lg">
                </div>
                
                <div class="w-full py-2 px-4 rounded-xl border border-[#b6b6b6] shadow bg-[#ffffff44] backdrop-blur-lg">
                    <label for="" class="flex gap-4 items-center">
                        <img src="{{asset('assets/img/YouTube.png')}}" class="w-12" alt="">
                        <p>Youtube</p>
                    </label>
                    <input type="text" name="social_yt" placeholder="Вставьте ссылку" value="{{$social_yt->link??''}}" class="w-full py-2 px-4 rounded-xl border border-[#b6b6b6] shadow bg-[#ffffff44] backdrop-blur-lg">
                </div>

                <div class="flex gap-6 mx-auto">
                    <button class="py-4 px-8 bg-[#B02F00] rounded-[50px] text-white text-xl font-medium hover:bg-[#992901] hover:scale-95 transition-transform duration-300 ease-in-out" type="submit">Сохранить изменения</button>
                    <button onclick="window.location={{route('profile.show', auth()->user()->id)}}">Отменить</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        const profileImageInput = document.getElementById('profileImageInput');
        const backgroundImageInput = document.getElementById('backgroundImageInput');

        function changeImg(event) {
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            if (profileImageInput.files.length > 0) {
                formData.append('profile_image', profileImageInput.files[0]);
            }
            if (backgroundImageInput.files.length > 0) {
                formData.append('background_image', backgroundImageInput.files[0]);
            }

            fetch('{{ route('profile.update') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (data.profile_image_path) {
                            document.getElementById('profileImage').src = data.profile_image_path;
                            profileImageInput.value = ''
                        }
                        if (data.background_image_path) {
                            document.getElementById('backgroundImage').src = data.background_image_path;
                            backgroundImageInput.value = ''
                        }
                    } else {
                        console.log('Ошибка обновления профиля.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    console.log('Ошибка при отправке данных.');
                });
        };
    </script>
@endsection
