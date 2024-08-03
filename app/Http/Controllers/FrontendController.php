<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $menus = Menu::where('status', 1)->orderByDesc('created_at')->get();
        $subcategories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        return view('frontend.index', compact('subcategories', 'menus', 'categories'));
    }
    public function subCategory()
    {
        $subcategories = SubCategory::with([
            'category' => function ($query) {
                $query->select('id', 'name'); 
            }
        ])->where('status', 1)
            ->orderByDesc('created_at')
            ->select('id', 'name', 'image', 'slug', 'total_price', 'discounted_price', 'discount', 'category_id')
            ->get();

        return view('frontend.service-grid', compact('subcategories'));
    }

}
