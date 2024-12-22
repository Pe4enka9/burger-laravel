<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function showLogin(): View
    {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'required' => 'Обязательное поле',
        ]);

        if (Auth::attempt($validated, true)) {
            $request->session()->regenerate();

            return redirect()->route('admin.index');
        }

        return back()->withErrors(['auth' => 'Неверный логин или пароль'])->withInput();
    }

    public function index(): View
    {
        return view('admin.index');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
