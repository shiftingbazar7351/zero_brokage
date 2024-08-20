<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\ServiceDetail;
use App\Models\SubCategory;
use App\Models\SubMenu;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        // $menus = Menu::where('status', 1)->orderByDesc('created_at')->get();
        $subcategories = Subcategory::where('status', 1)->orderByDesc('created_at')->get();
        return view('frontend.home', compact('subcategories'));
    }
    public function subCategory($slug)
    {
        $subcategories = SubCategory::select('id', 'name','icon')->get();
        $subcategory = SubCategory::where('slug', $slug)->select('id', 'name','background_image')->first();
        if (!$subcategory) {
            abort(404, 'Category not found');
        }
        $submenus = SubMenu::with([
            'category' => function ($query) {
                $query->select('id', 'name');
            }
        ])
            ->where('category_id', $subcategory->id) // Filter by category_id
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->select('id', 'name', 'image', 'slug', 'total_price', 'discounted_price', 'discount', 'category_id')
            ->paginate(20);
        return view('frontend.service-list', compact('submenus', 'subcategory','subcategories'));
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
