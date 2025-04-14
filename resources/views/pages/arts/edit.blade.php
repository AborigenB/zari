@extends('template.second')

@section('content')
    <x-arts.editForm :$art :$materials :$styles :$tags></x-arts.editForm>
@endsection