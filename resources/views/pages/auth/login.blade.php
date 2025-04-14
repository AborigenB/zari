@extends('template.second')

@section('content')
    <div class="regist relative mx-auto my-24 w-full max-w-6xl p-10">
        <form
            class="flex w-full flex-col items-center gap-5 bg-[#ffffff20] shadow backdrop-blur-[6.15px] rounded-[50px] p-20"
            method="POST" name="auth" action="{{ route('user.auth') }}">
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
                        class="w-full h-12 outline-0 bg-white/30 border border-white shadow-lg backdrop-blur-lg rounded-full px-10 text-2xl text-white placeholder:text-white/40 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button type="submit"
                class="mt-5 w-full h-24 bg-red-700 border border-white shadow-lg backdrop-blur-lg rounded-full text-2xl text-white font-bold hover:bg-red-800 transform hover:scale-95 transition-transform duration-300">Авторизоваться</button>
            <div class="bottom__authorization flex justify-between gap-20">
                <a href="{{ route('register') }}"
                    class="text-white font-medium hover:scale-95 transition-transform duration-300">Зарегистрироваться</a>
                <a href="#" class="text-white font-medium hover:scale-95 transition-transform duration-300">Забыли
                    пароль?</a>
            </div>
        </form>
    </div>
@endsection
