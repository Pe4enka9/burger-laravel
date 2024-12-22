@extends('layouts.main')
@section('title', 'Админ панель')

@section('content')

    <a href="{{ route('admin.logout') }}" class="mb-3 btn btn-primary">Выйти</a>
    <h1 class="mb-3">@yield('title')</h1>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary">Категории</a>
    <a href="{{ route('admin.burgers.index') }}" class="btn btn-outline-primary">Бургеры</a>

@endsection
