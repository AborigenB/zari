@extends('pages.auth.profile.index')

@section('profile-content')
    <div class="mt-4 flex flex-col">
        <a href="{{route('art.create')}}" class="bg-[#3D2121] font-nikyousans text-white px-8 py-4 rounded-full uppercase text-xl mr-auto">Добавить</a>
        
        <div class="flex flex-col gap-4 w-[600px]">
            <div class="w-full">
                <img class="w-full" src="{{asset('assets/img/2017_NYR_14314_0008_000(albert_bierstadt_twilight_lake_tahoe124324).jpg')}}" alt="">
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <img class="flex-1/2" src="{{asset('assets/img/2017_NYR_14314_0008_000(albert_bierstadt_twilight_lake_tahoe124324).jpg')}}" alt="">
                </div>
                <div class="w-full">
                    <img class="flex-1/2" src="{{asset('assets/img/2017_NYR_14314_0008_000(albert_bierstadt_twilight_lake_tahoe124324).jpg')}}" alt="">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 py-10">
            <x-art-items :$arts></x-art-items>
        </div>
    </div>    


@endsection
