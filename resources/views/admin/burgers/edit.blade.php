@extends('layouts.main')
@section('title', 'Изменить бургер')

@section('content')

    <a href="{{ route('admin.burgers.index') }}" class="mb-3 btn btn-secondary">Назад</a>
    <h1 class="mb-3">@yield('title')</h1>

    <div class="row">
        <div class="col-3">
            <form action="{{ route('admin.burgers.update', $burger->slug) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" name="name" id="name"
                           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           value="{{ $burger->name }}" autofocus>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Название</label>
                    <textarea name="description" id="description"
                              class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ $burger->description }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <select name="category_id" id="category_id" class="form-select">
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ $category->id == $burger->category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <input type="file" name="image" id="image"
                           class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input type="submit" value="Изменить" class="btn btn-success">
            </form>
        </div>
    </div>

@endsection
