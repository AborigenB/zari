@extends('template.second')

@section('content')
    <x-arts.createForm :$materials :$styles :$tags></x-arts.createForm>
@endsection