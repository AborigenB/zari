@extends('pages.auth.profile.index')

@section('profile-content')
    <div class="mt-4 flex flex-col">
    
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 py-10">
            <x-art-items :$arts></x-art-items>
        </div>
    </div>    


@endsection
