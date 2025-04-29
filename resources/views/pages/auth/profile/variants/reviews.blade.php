@extends('pages.auth.profile.index')

@section('profile-content')
    <div class="flex flex-col gap-10 mt-10">
        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-noto-serif-kr">Рецензии Пользователя</h2>
            {{-- <div class="flex gap-12">
                <button class="bg-[#ffffff05] px-6 py-4 rounded-full text-2xl"
                    style='box-shadow: 0px 0px 18.3px rgba(0, 0, 0, 0.25);' id="review_prev">
                < </button>
                <button class="bg-[#ffffff05] px-6 py-4 rounded-full text-2xl"
                    style='box-shadow: 0px 0px 18.3px rgba(0, 0, 0, 0.25);' id="review_next">></button>
            </div> --}}
        </div>
        <div class="flex flex-col gap-6" id="review_scroller">
            @forelse ($reviews as $review)
                <div class="flex flex-col gap-13 bg-[#ffffff23] py-8 px-12 rounded-3xl relative"
                    style="box-shadow: 14.5282px 20.5104px 85.4599px rgba(0, 0, 0, 0.06)">
                    <div class="absolute flex gap-4 bottom-6 right-6">
                        <a class="bg-[#ffffff4d] backdrop-blur-sm flex items-center justify-center p-4 rounded-full" href="{{route('review.edit', $review->id)}}">
                            <img class="w-8 h-8" src="{{asset('assets/img/svg/edit.svg')}}" alt="">
                        </a>
                        <a class="bg-[#ffffff4d] backdrop-blur-sm flex items-center justify-center p-4 rounded-full" href="{{route('review.delete', $review->id)}}">
                            <img class="w-8 h-8" src="{{asset('assets/img/svg/delete.svg')}}" alt="">
                        </a>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex gap-5 items-center">
                            <div class="w-24 h-24">
                                <img class="object-cover w-full h-full rounded-full"
                                    src="{{ asset('storage/' . $review->user->images[0]->url) }}" alt="">
                            </div>
                            <div class="flex flex-col gap-5">
                                <h2 class="font-noto-serif-kr text-3xl">{{ $review->user->login }}</h2>
                                <p class="font-noto-serif-kr text-2xl">{{ $review->updated_at }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h2 class="font-noto-serif-kr text-7xl ml-auto">{{ $review->getTotalScoreAttribute() }}</h2>
                            <div class="flex gap-4">
                                <p class="font-noto-serif-kr text-xl">{{ $review->score1 }}</p>
                                <p class="font-noto-serif-kr text-xl">{{ $review->score2 }}</p>
                                <p class="font-noto-serif-kr text-xl">{{ $review->score3 }}</p>
                                <p class="font-noto-serif-kr text-xl">{{ $review->score4 }}</p>
                                <p class="font-noto-serif-kr text-xl">{{ $review->score5 }}</p>
                                <p class="font-noto-serif-kr text-xl">{{ $review->score6 }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-8">
                        <h2 class="font-noto-serif-kr text-xl">Рецензия на: <a class="underline" href="{{route('art.show', $review->art->id)}}">{{ $review->art->title }}</a></h2>
                        <h2 class="font-noto-serif-kr text-3xl">{{ $review->title }}</h2>
                        <p class="font-noto-serif-kr text-2xl max-w-full break-words"> {{ $review->description }} </p>
                    </div>
                </div>
            @empty
                Отзывов нет
            @endforelse
        </div>
    </div>
@endsection
