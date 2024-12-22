<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();

        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:categories,name', 'max:255'],
        ], [
            'required' => 'Обязательное поле',
            'unique' => 'Такая категория уже существует',
            'max' => 'Длина не должна превышать :max символов'
        ]);

        Category::query()->create([
            'name' => $validated['name'],
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function edit(int $id): View
    {
        $category = Category::query()->findOrFail($id);

        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:categories,name', 'max:255'],
        ], [
            'required' => 'Обязательное поле',
            'unique' => 'Такая категория уже существует',
            'max' => 'Длина не должна превышать :max символов'
        ]);

        Category::query()->findOrFail($id)->update([
            'name' => $validated['name'],
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        Category::query()->findOrFail($id)->delete();

        return redirect()->route('admin.categories.index');
    }
}
