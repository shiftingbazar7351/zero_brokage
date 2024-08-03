<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $menus = Menu::orderByDesc('created_at')->get();
        $subcategories = Category::orderByDesc('created_at')->get();
        $categories = Category::orderByDesc('created_at')->get();
        return view('frontend.index', compact('subcategories','menus','categories'));
    }
}
