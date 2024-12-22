@extends('layouts.main')
@section('title', 'Изменить категорию')

@section('content')

    <a href="{{ route('admin.categories.index') }}" class="mb-3 btn btn-secondary">Назад</a>
    <h1 class="mb-3">@yield('title')</h1>

    <div class="row">
        <div class="col-3">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" name="name" id="name"
                           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           value="{{ $category->name }}" autofocus>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input type="submit" value="Изменить" class="btn btn-success">
            </form>
        </div>
    </div>

@endsection
