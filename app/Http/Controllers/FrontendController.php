<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\ServiceDetail;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        // $menus = Menu::where('status', 1)->orderByDesc('created_at')->get();
        $subcategories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        return view('frontend.index', compact('subcategories','categories'));
    }
    public function subCategory($slug)
    {
        $categories = Category::select('id', 'name','icon')->get();
        $category = Category::where('slug', $slug)->select('id', 'name','image')->first();
        if (!$category) {
            abort(404, 'Category not found');
        }
        $subcategories = SubCategory::with([
            'category' => function ($query) {
                $query->select('id', 'name');
            }
        ])
            ->where('category_id', $category->id) // Filter by category_id
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->select('id', 'name', 'image', 'slug', 'total_price', 'discounted_price', 'discount', 'category_id')
            ->paginate(20);
        return view('frontend.service-grid', compact('subcategories', 'category','categories'));
    }
    public function serviceDetails()
    {
        // $menus = Menu::where('status', 1)->orderByDesc('created_at')->get();
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $categories = Category::orderByDesc('created_at')->get();
        $services = ServiceDetail::orderByDesc('created_at')->first();
        return view('frontend.service-details',compact('subcategories','categories','services'));
    }

    public function serviceList()
    {
        $categories = Category::get();
        return view('frontend.service-list',compact('categories'));
    }

}
