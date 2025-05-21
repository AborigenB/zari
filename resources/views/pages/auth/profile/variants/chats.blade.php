@extends('pages.auth.profile.index')

@section('profile-content')
    <div class="mt-4 flex flex-col">
        <h2 class="text-2xl font-bold mb-4">Чаты</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($chatUsers as $chatUser)
                <div class="group h-fit bg-white/20 border border-gray-200 rounded-[42px] p-3 overflow-hidden shadow-sm">
                    <a href="{{ route('profile.chat', ['id' => $chatUser->id]) }}" class="flex items-center space-x-4">
                        <img src="{{ asset($chatUser->profileImage()) }}"
                             alt="{{ $chatUser->login }} avatar" class="w-12 h-12 rounded-full">
                        <div>
                            <p class="text-lg font-semibold">{{ $chatUser->login }}</p>
                            <p class="text-gray-600">{{ $chatUser->description }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    
@endsection
