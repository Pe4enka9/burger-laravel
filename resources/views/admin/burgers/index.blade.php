@extends('layouts.main')
@section('title', 'Бургеры')

@section('content')

    <a href="{{ route('admin.index') }}" class="mb-3 btn btn-secondary">Назад</a>
    <h1 class="mb-3">@yield('title')</h1>
    <a href="{{ route('admin.burgers.create') }}" class="mb-3 btn btn-primary">Добавить</a>

    <div class="row">
        @foreach($burgers as $burger)
            <div class="col">
                <div class="card">
                    <img src="{{ asset('images/' . $burger->image) }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $burger->name }}</h5>
                        <p class="card-text">{{ $burger->description }}</p>
                        <p class="card-text">Категория: {{ $burger->category->name }}</p>
                        <a href="{{ route('admin.burgers.show', $burger->slug) }}" class="mb-3 btn btn-primary">Подробнее</a>
                        <a href="{{ route('admin.burgers.edit', $burger->slug) }}" class="mb-3 btn btn-info">Изменить</a>
                        <form action="{{ route('admin.burgers.destroy', $burger->slug) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Удалить" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
