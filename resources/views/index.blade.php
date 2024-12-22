@extends('layouts.main')
@section('title', 'Главная')

@section('content')

    <h1 class="mb-3">@yield('title')</h1>

    <div class="row mb-3">
        <div class="col">
            <form>
                <div class="d-flex gap-3">
                    <div class="mb-3">
                        <label for="category" class="form-label">Категория</label>
                        <select name="category" id="category" class="form-select">
                            <option value="all">Все</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sorting" class="form-label">Сортировка</label>
                        <select name="sorting" id="sorting" class="form-select">
                            <option value="asc">По самому старому</option>
                            <option value="desc" {{ request('sorting') == 'desc' ? 'selected' : '' }}>По самому новому
                            </option>
                        </select>
                    </div>
                </div>

                <input type="submit" value="Искать" class="btn btn-success">
                <a href="{{ url()->current() }}" class="btn btn-danger">Сбросить</a>
            </form>
        </div>
    </div>

    <div class="row">
        @foreach($burgers as $burger)
            <div class="col">
                <div class="card">
                    <img src="{{ asset('images/' . $burger->image) }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $burger->name }}</h5>
                        <p class="card-text">{{ $burger->description }}</p>
                        <p class="card-text">Категория: {{ $burger->category->name }}</p>
                        <a href="{{ route('show', $burger->slug) }}" class="mb-3 btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
