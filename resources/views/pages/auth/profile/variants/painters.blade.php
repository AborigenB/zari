@extends('template.second')

@section('content')

    <div class="container relative mx-auto">
        <div class="ml-auto absolute -top-12 right-0">
            <form action="" method="get" class="flex gap-10 items-center">
                <input class="px-4 py-2 w-96 bg-[#fdf9f91e] border border-[#fdf9f9] rounded-full"
                    style="box-shadow:0px 0px 18.3px rgba(0, 0, 0, 0.25);" placeholder="Введите название работы"
                    type="text">
                <button type="submit">Поиск</button>
            </form>
        </div>
        <div class="flex flex-col gap-15 py-16">
            {{-- {{dd($users)}} --}}
            @forelse ($users as $user)
                <div class="flex gap-5 items-center">
                    <div class="w-2/12 flex flex-col items-center gap-5">
                        {{-- {{dd($user->profileImage)}} --}}
                        <div class="rounded-full w-24 h-24 overflow-hidden">
                            <img class="h-full object-cover" src="{{ asset('storage/' . $user->profileImage()) }}" alt="">
                        </div>
                        <h2>{{ $user->login }}</h2>
                    </div>

                    <div class="w-10/12 flex items-center gap-5" id="sliderbox">

                        <button class="bg-[#ffffff05] px-6 py-4 rounded-full text-2xl"
                            style='box-shadow: 0px 0px 18.3px rgba(0, 0, 0, 0.25);' id="artsPrev">
                            < 
                        </button>

                        <div class="flex items-center overflow-hidden snap-x snap-mandatory" id="artSlider">
                            <div class="flex items-center gap-8">
                                @foreach ($user->arts as $art)
                                    <div class="max-h-64 overflow-hidden w-64 snap-start" id="card">
                                        <img class="w-64" src="{{ asset('storage/' . $art->images[0]->url) }}"
                                            alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button class="bg-[#ffffff05] px-6 py-4 rounded-full text-2xl"
                            style='box-shadow: 0px 0px 18.3px rgba(0, 0, 0, 0.25);' id="artsNext">
                            >
                        </button>

                    </div>
                </div>
            @empty
                Художников нету
            @endforelse
        </div>
    </div>
    <script src="{{ asset('assets/js/painters.js') }}" defer></script>
@endsection
