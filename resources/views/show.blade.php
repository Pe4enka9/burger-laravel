@extends('layouts.main')
@section('title', $burger->name)

@section('content')

    <a href="{{ url()->previous() }}" class="mb-3 btn btn-secondary">Назад</a>
    <h1 class="mb-3">@yield('title')</h1>

    <img src="{{ asset('images/' . $burger->image) }}" class="mb-3 img-thumbnail" alt="">
    <div class="mb-3">Категория: {{ $burger->category->name }}</div>
    <p class="mb-3">{{ $burger->description }}</p>

@endsection
