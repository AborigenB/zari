@extends('template.second')

@section('content')
    <div class="container mx-auto py-19">
        <h2 class="text-3xl mb-8 font-montseratblack">Учётная запись</h2>
        <div class="flex">
            <div class="flex flex-col items-center gap-8">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-24 h-24">
                        <img class="h-full rounded-full object-cover" src="{{asset($user->profileImage())}}" alt="">
                    </div>
                    <p class="text-xl font-montserrat">{{$user->login}}</p>
                </div>

                <div class="flex flex-col items-center gap-4" id="buttons">
                    <button class="py-2 px-8 transition duration-700 scale-90 w-max text-lg items-center bg-[#ffffff3d] backdrop-blur-sm rounded-[10px] border border-white text-black flex gap-4" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><img class="w-8 h-8" src="{{asset('assets/img/svg/password.svg')}}" alt=""> Смена пароля</button>
                    <button class="py-2 px-8 transition duration-700 w-max text-lg items-center bg-[#ffffff5b] backdrop-blur-sm rounded-[10px] border border-white text-black flex gap-4" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><img class="w-8 h-8" src="{{asset('assets/img/svg/mail.svg')}}" alt=""> Смена почты</button>
                    <button class="py-2 px-8 transition duration-700 w-max text-lg items-center bg-[#ffffff5b] backdrop-blur-sm rounded-[10px] border border-white text-black flex gap-4" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><img class="w-8 h-8" src="{{asset('assets/img/svg/translate.svg')}}" alt=""> Смена языка</button>
                    <button class="py-2 px-8 transition duration-700 w-max text-lg items-center bg-[#ffffff5b] backdrop-blur-sm rounded-[10px] border border-white text-black flex gap-4" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><img class="w-8 h-8" src="{{asset('assets/img/svg/theme.svg')}}" alt=""> Смена темы</button>
                </div>
            </div>

            <div class="w-full" id="items">
                <div class="flex flex-col gap-4 w-full px-8" id="password">
                    <h2 class="text-2xl font-montserrat">Сменить пароль</h2>
                    <form action="" class="flex flex-col gap-6">
                        <div class="flex flex-col gap-2">
                            <label for="oldPassword" class="ml-5 text-xl text-black">Старый пароль</label>
                            <input type="password" id="oldPassword" name="oldPassword"
                                class="w-full h-12 outline-0 bg-white/30 border border-white shadow-lg backdrop-blur-lg rounded-full px-10 text-xl text-black placeholder:text-black/40 @error('oldPassword') border-red-500 @enderror"
                                value="{{ old('oldPassword') }}">
                            @error('oldPassword')
                                <p class="text-red-500 text-sm italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="password" class="ml-5 text-xl text-black">Новый пароль</label>
                            <input type="password" id="password" name="password" 
                                class="w-full h-12 outline-0 bg-white/30 border border-white shadow-lg backdrop-blur-lg rounded-full px-10 text-xl text-black placeholder:text-black/40 @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="text-red-500 text-sm italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="password_confirmation" class="ml-5 text-xl text-black">Повторите новый пароль</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full h-12 outline-0 bg-white/30 border border-white shadow-lg backdrop-blur-lg rounded-full px-10 text-xl text-black placeholder:text-black/40 @error('password_confirmation') border-red-500 @enderror">
                            @error('password_confirmation')
                                <p class="text-red-500 text-sm italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                        class="mt-5 w-full h-24 bg-red-700 border border-white shadow-lg backdrop-blur-lg rounded-full text-xl text-white hover:bg-red-800 transform hover:scale-95 transition-transform duration-300">Сменить пароль</button>
                    </form>
                </div>
                
                <div class="hidden flex-col gap-4 w-full px-8" id="email">
                    <h2 class="text-2xl font-montserrat">Сменить почту</h2>
                    <form action="" class="flex flex-col gap-6">
                        <div class="flex flex-col gap-2">
                            <label for="oldEmail" class="ml-5 text-xl text-black">Старая почта</label>
                            <input type="email" id="oldEmail" name="oldEmail"
                                class="w-full h-12 outline-0 bg-white/30 border border-white shadow-lg backdrop-blur-lg rounded-full px-10 text-xl text-black placeholder:text-black/40 @error('oldEmail') border-red-500 @enderror"
                                value="{{ old('oldEmail') }}">
                            @error('oldEmail')
                                <p class="text-red-500 text-sm italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="newEmail" class="ml-5 text-xl text-black">Новая почта</label>
                            <input type="email" id="newEmail" name="newEmail" 
                                class="w-full h-12 outline-0 bg-white/30 border border-white shadow-lg backdrop-blur-lg rounded-full px-10 text-xl text-black placeholder:text-black/40 @error('newEmail') border-red-500 @enderror">
                            @error('newEmail')
                                <p class="text-red-500 text-sm italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <button type="submit"
                        class="mt-5 w-full h-24 bg-red-700 border border-white shadow-lg backdrop-blur-lg rounded-full text-xl text-white hover:bg-red-800 transform hover:scale-95 transition-transform duration-300">Сменить почту</button>
                    </form>
                </div>
                
                <div class="hidden" id="language">
    
                </div>
                
                <div class="hidden" id="theme">
    
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/editProfile.js')}}" defer></script>
@endsection