@extends('layouts.main')
@section('title', 'Авторизация')

@section('content')

    <h1 class="mb-3">@yield('title')</h1>

    <div class="row">
        <div class="col-4">
            <form action="{{ route('admin.login') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" name="login" id="login"
                           class="form-control {{ $errors->has('login') || $errors->has('auth')  ? 'is-invalid' : '' }}"
                           value="{{ old('login') }}">
                    @error('login')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" name="password" id="password"
                           class="form-control {{ $errors->has('password') || $errors->has('auth') ? 'is-invalid' : '' }}">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @error('auth')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <input type="submit" value="Войти" class="btn btn-success">
            </form>
        </div>
    </div>

@endsection
