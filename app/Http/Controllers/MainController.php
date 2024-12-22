<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(Request $request): View
    {
        $burgers = Burger::filter($request->all())->get();
        $categories = Category::all();

        return view('index', ['burgers' => $burgers, 'categories' => $categories]);
    }
}
