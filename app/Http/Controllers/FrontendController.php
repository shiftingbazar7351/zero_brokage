<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\ServiceDetail;
use App\Models\SubCategory;
use App\Models\SubMenu;

class FrontendController extends Controller
{
    public function home()
    {
        $subcategories = Subcategory::where('status', 1)
            ->orderByDesc('created_at')
            ->get();
        $trendingsubcat = $subcategories->where('trending', 1);
        $featuresubcat = $subcategories->where('featured', 1);
        return view('frontend.home', compact('subcategories', 'trendingsubcat', 'featuresubcat'));
    }

    public function subCategory($slug)
    {
         $menus = Menu::select('id','name','image','slug','category_id','subcategory_id')->where('status',1)->get();
        $subcategory = SubCategory::where('slug', $slug)->select('id', 'slug', 'name', 'background_image')->first();
        if (!$subcategory) {
            abort(404, 'Category not found');
        }
        $submenus = SubMenu::with(['subCategory', 'menu'])
            ->where('subcategory_id', $subcategory->id ?? '')->where('status', 1)
            ->orderByDesc('created_at')
            ->select('id', 'name', 'image', 'slug', 'total_price', 'discounted_price', 'discount', 'subcategory_id', 'menu_id','city_id')
            ->get();
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
