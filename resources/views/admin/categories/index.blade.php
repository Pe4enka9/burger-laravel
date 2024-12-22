@extends('layouts.main')
@section('title', 'Категории')

@section('content')

    <a href="{{ url()->previous() }}" class="mb-3 btn btn-secondary">Назад</a>
    <h1 class="mb-3">@yield('title')</h1>
    <a href="{{ route('admin.categories.create') }}" class="mb-3 btn btn-primary">Добавить</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Название</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">Изменить</a>
                </td>
                <td>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Удалить" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
