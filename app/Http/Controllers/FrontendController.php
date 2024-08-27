<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Faq;
use App\Models\IndiaServiceDescription;
use App\Models\Menu;
use App\Models\ServiceDetail;
use App\Models\State;
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
        $menus = Menu::select('id', 'name', 'image', 'slug', 'category_id', 'subcategory_id')->where('status', 1)->get();
        $subcategory = SubCategory::where('slug', $slug)->select('id', 'slug', 'name', 'background_image')->first();
        if (!$subcategory) {
            abort(404, 'Category not found');
        }
        $submenus = SubMenu::with(['subCategory', 'menu','cityName.state'])
            ->where('subcategory_id', $subcategory->id ?? '')
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->select('id', 'name', 'image', 'slug', 'total_price', 'discounted_price', 'discount', 'subcategory_id', 'menu_id', 'city_id' ,'description','details')
            ->get();

        return view('frontend.service-list', compact('submenus', 'subcategory', 'menus'));
    }
    public function servicesInIndia()
    {
        $faqs = Faq::where('status',1)->select('question','answer')->get();
        $description = IndiaServiceDescription::first();
        $submenus = SubMenu::with(['subCategory', 'menu','cityName.state'])
        ->where('status', 1)
        ->orderByDesc('created_at')
        ->select('id', 'name', 'image', 'slug', 'total_price', 'discounted_price', 'discount', 'subcategory_id', 'menu_id', 'city_id' ,'description','details')
        ->get();
        return view('frontend.services-in-india',compact('faqs','submenus','description'));
    }

    public function servicesInIndiaCity()
    {
        $faqs = Faq::where('status',1)->select('question','answer')->get();
        $description = IndiaServiceDescription::first();
        $submenus = SubMenu::with(['subCategory', 'menu','cityName.state'])
        ->where('status', 1)
        ->orderByDesc('created_at')
        ->select('id', 'name', 'image', 'slug', 'total_price', 'discounted_price', 'discount', 'subcategory_id', 'menu_id', 'city_id' ,'description','details')
        ->get();
        return view('frontend.service-in-india-city',compact('faqs','submenus','description'));
    }


}
