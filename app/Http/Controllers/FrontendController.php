<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $menu = Menu::orderByDesc('created_at')->get();
        $subcat = Category::orderByDesc('created_at')->get();
        $cat = Category::orderByDesc('created_at')->get();
        return view('frontend.index', [
            'menus' => $menu,
            'categories' => $cat,
            'subCategories' => $subcat  
        ]);
    }
}
