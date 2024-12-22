<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BurgerController extends Controller
{
    public function index(): View
    {
        $burgers = Burger::all();

        return view('admin.burgers.index', ['burgers' => $burgers]);
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('admin.burgers.create', ['categories' => $categories]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:burgers,name', 'max:255'],
            'description' => ['required'],
            'category_id' => ['required'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ], [
            'required' => 'Обязательное поле',
            'unique' => 'Такой бургер уже существует',
            'max' => 'Длина не должна превышать :max символов',
        ]);

        $image = $request->file('image');
        $path = uniqid('img_', true) . '.' . $image->extension();
        $image->move(public_path('images'), $path);

        Burger::query()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'image' => $path,
            'slug' => Str::slug($validated['name'])
        ]);

        return redirect()->route('admin.burgers.index');
    }

    public function edit(string $slug): View
    {
        $burger = Burger::query()->where('slug', $slug)->firstOrFail();
        $categories = Category::all();

        return view('admin.burgers.edit', ['burger' => $burger, 'categories' => $categories]);
    }

    public function update(Request $request, string $slug): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['required'],
            'category_id' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ], [
            'required' => 'Обязательное поле',
            'max' => 'Длина не должна превышать :max символов',
        ]);

        $burger = Burger::query()->where('slug', $slug)->firstOrFail();

        if ($request->hasFile('image')) {
            unlink(public_path('images/') . $burger->image);

            $image = $request->file('image');
            $path = uniqid('img_', true) . '.' . $image->extension();
            $image->move(public_path('images'), $path);
        } else {
            $path = $burger->image;
        }

        $burger->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'image' => $path,
            'slug' => Str::slug($validated['name'])
        ]);

        return redirect()->route('admin.burgers.index');
    }

    public function destroy(string $slug): RedirectResponse
    {
        Burger::query()->where('slug', $slug)->firstOrFail()->delete();

        return redirect()->route('admin.burgers.index');
    }

    public function show(string $slug): View
    {
        $burger = Burger::query()->where('slug', $slug)->firstOrFail();

        return view('admin.burgers.show', ['burger' => $burger]);
    }

    public function showUser(string $slug): View
    {
        $burger = Burger::query()->where('slug', $slug)->firstOrFail();

        return view('show', ['burger' => $burger]);
    }
}
