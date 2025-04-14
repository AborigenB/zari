@extends('template.second')

@section('content')
    <div class="regist relative mx-auto my-24 w-full max-w-6xl p-10">
        <form
            class="flex w-full flex-col items-center gap-5 bg-[#ffffff20] shadow backdrop-blur-[6.15px] rounded-[50px] p-20"
            method="POST" name="reg" action="{{ route('user.reg') }}">
            @csrf
            <div class="flex flex-col gap-5 w-full">
                <div class="flex flex-col gap-2">
                    <label for="email" class="ml-5 text-2xl text-white font-bold">Почта</label>
                    <input type="email" id="email" name="email" placeholder="Введите почту"
                        class="w-full h-12 outline-0 bg-white/30 border border-white shadow-lg backdrop-blur-lg rounded-full px-10 text-2xl text-white placeholder:text-white/40 @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-sm italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password" class="ml-5 text-2xl text-white font-bold">Пароль</label>
                    <input type="password" id="password" name="password" placeholder="Введите пароль"
                        value="{{ old('password') }}"
                        class="w-full h-12 outline-0 bg-white/30 border border-white shadow-lg backdrop-blur-lg rounded-full px-10 text-2xl text-white placeholder:text-white/40 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="password_confirmation" class="ml-5 text-2xl text-white font-bold">Повторите пароль</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Введите повторно пароль"
                        value="{{ old('password_confirmation') }}"
                        class="w-full h-12 outline-0 bg-white/30 border border-white shadow-lg backdrop-blur-lg rounded-full px-10 text-2xl text-white placeholder:text-white/40 @error('password_confirmation') border-red-500 @enderror">
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="terms" name="terms" required class="hidden">
                <label for="terms" class="cursor-pointer block w-5 h-5 border border-white rounded-full relative">
                    <span class="absolute inset-0 flex items-center justify-center text-white text-xl"
                        style="display: none;">✓</span>
                </label>
                <p class="ml-5 text-lg text-white font-medium">Регистрируясь на сайте вы подтверждаете, что вы согласны с
                    нашей «политикой конфиденциальности и обработкой персональных данных»</p>
            </div>

            <button type="submit"
                class="mt-5 w-full h-24 bg-red-700 border border-white shadow-lg backdrop-blur-lg rounded-full text-2xl text-white font-bold hover:bg-red-800 transform hover:scale-95 transition-transform duration-300">Зарегистрироваться</button>
            <div class="bottom__registration flex justify-between gap-20">
                <a href="{{ route('login') }}"
                    class="text-white font-medium hover:scale-95 transition-transform duration-300">Авторизоваться</a>
                <a href="{{ route('home') }}"
                    class="text-white font-medium hover:scale-95 transition-transform duration-300">Вернуться назад</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('terms').addEventListener('change', function() {
            const label = this.nextElementSibling.querySelector('span');
            if (this.checked) {
                label.style.display = 'block';
            } else {
                label.style.display = 'none';
            }
        });
    </script>
@endsection
