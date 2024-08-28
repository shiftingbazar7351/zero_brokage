<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Enquiry;
use App\Models\Faq;
use App\Models\IndiaServiceDescription;
use App\Models\Menu;
use App\Models\ServiceDetail;
use App\Models\State;
use App\Models\SubCategory;
use App\Models\SubMenu;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function home()
    {
        $subcategories = Subcategory::where('status', 1)
            ->orderByDesc('created_at')
            ->get();
        $trendingsubcat = $subcategories->where('trending', 1);
        $featuresubcat = $subcategories->where('featured', 1);
        $providers = Vendor::with(['subCategory:id,name'])->where('status',1)
        ->select('id','vendor_name','sub_category','vendor_image','price','review_count')
        ->orderByDesc('created_at')
        ->get();
        return view('frontend.home', compact('subcategories', 'trendingsubcat', 'featuresubcat','providers'));
    }
    public function subCategory($slug)
    {
        $subcategory = SubCategory::where('slug', $slug)->select('id', 'slug', 'name', 'background_image')->first();
        $menus = Menu::select('id', 'name', 'image', 'slug', 'category_id', 'subcategory_id')
        ->where('subcategory_id',$subcategory->id)
        ->where('status', 1)
        ->get();
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

    public function enquiryStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $enquiry = new Enquiry();
        $enquiry->mobile_number = $request->mobile_number;
        $enquiry->save();

        return response()->json(['success' => 'Mobile number saved successfully']);
    }

    public function enquiryUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // 'move_from_origin' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Assuming you're updating the enquiry based on mobile number or some other identifier
        $enquiry = Enquiry::where('mobile_number', $request->mobile_number)->first();
        if ($enquiry) {
            $enquiry->name = $request->name;
            $enquiry->move_from_origin = $request->move_from_origin;
            $enquiry->email = $request->email;
            $enquiry->date = $request->date;
            $enquiry->save();

            return response()->json(['success' => 'Details updated successfully']);
        }

        return response()->json(['error' => 'Enquiry not found'], 404);
    }


}
