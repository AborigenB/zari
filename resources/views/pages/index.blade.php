@extends('template.main')

@section('content')
    <x-mainpage.aboutwe></x-mainpage.aboutwe>

    <x-mainpage.slider :arts="$arts"></x-mainpage.slider>

    <x-mainpage.faq></x-mainpage.faq>

    <x-mainpage.contact></x-mainpage.contact>

    <div class="fixed z-50 bottom-3 right-3" id="responseMessage">
    </div>
@endsection
