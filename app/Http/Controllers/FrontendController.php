<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ServiceDetail;

class FrontendController extends Controller
{
    public function home()
    {
        // Fetch all subcategories with status = 1, trending subcategories, and featured subcategories
        $subcategories = Subcategory::where('status', 1)
            ->orderByDesc('created_at')
            ->get();

        $trendingsubcat = $subcategories->where('trending', 1);
        $featuresubcat = $subcategories->where('featured', 1);

        return view('frontend.home', compact('subcategories', 'trendingsubcat', 'featuresubcat'));
    }

    public function subCategory($slug)
    {
        $menus = Menu::get();
        $subcategory = SubCategory::where('slug', $slug)->select('id', 'name', 'background_image')->first();
        if (!$subcategory) {
            abort(404, 'Category not found');
        }
       $submenus = SubMenu::with([
            'category' => function ($query) {
                $query->select('id', 'name');
            },
        ])
            ->where('category_id', $subcategory->id) // Filter by category_id
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->select('id', 'name', 'image', 'slug', 'total_price', 'discounted_price', 'discount', 'category_id')
            ->paginate(20);
        return view('frontend.service-list', compact('submenus', 'subcategory', 'menus'));
    }
    public function serviceDetails()
    {
        // $menus = Menu::where('status', 1)->orderByDesc('created_at')->get();
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $categories = Category::orderByDesc('created_at')->get();
        $services = ServiceDetail::orderByDesc('created_at')->first();
        return view('frontend.service-details', compact('subcategories', 'categories', 'services'));
    }

    public function serviceList()
    {
        $categories = Category::get();
        return view('frontend.service-list', compact('categories'));
    }

}
