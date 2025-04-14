@extends('template.main')

@section('content')
    <x-mainpage.aboutwe></x-mainpage.aboutwe>

    <x-mainpage.slider :arts="$arts"></x-mainpage.slider>

    <x-mainpage.faq></x-mainpage.faq>

    <x-mainpage.contact></x-mainpage.contact>
    

@endsection
