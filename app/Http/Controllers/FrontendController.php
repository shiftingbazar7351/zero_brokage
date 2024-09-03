<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Enquiry;
use App\Models\Faq;
use App\Models\IndiaServiceDescription;
use App\Models\Menu;
use App\Models\Review;
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
            ->select('id', 'name', 'slug', 'icon')
            ->get();
        $trendingsubcat = $subcategories->where('trending', 1);
        $featuresubcat = $subcategories->where('featured', 1);
        $providers = Vendor::with(['subCategory:id,name'])->where('status', 1)
            ->select('id', 'vendor_name', 'sub_category', 'vendor_image', 'price', 'review_count')
            ->orderByDesc('created_at')
            ->get();
        $reviews = Review::where('status', 1)
            ->select('id', 'description', 'name', 'profession', 'status')
            ->get();
        return view('frontend.home', compact('subcategories', 'trendingsubcat', 'featuresubcat', 'providers', 'reviews'));
    }
    public function subCategory($slug)
    {
        $subcategory = SubCategory::where('slug', $slug)->select('id', 'slug', 'name', 'background_image')->first();
        $menus = Menu::select('id', 'name', 'image', 'slug', 'category_id', 'subcategory_id')
            ->where('subcategory_id', $subcategory->id ?? '')
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->get();
        if (!$subcategory) {
            abort(404, 'Category not found');
        }
        $submenus = SubMenu::join('menus', 'sub_menus.menu_id', '=', 'menus.id') // Join the menus table
            ->with(['subCategory', 'menu', 'cityName.state']) // Eager load relationships
            ->where('sub_menus.subcategory_id', $subcategory->id ?? '') // Specify the table for subcategory_id
            ->where('sub_menus.status', 1) // Specify the table for status
            ->orderByDesc('menus.created_at') // Order by a field from the menus table
            ->select(
                'sub_menus.id as submenu_id',
                'sub_menus.name',
                'sub_menus.image',
                'sub_menus.slug',
                'sub_menus.total_price',
                'sub_menus.discounted_price',
                'sub_menus.discount',
                'sub_menus.subcategory_id',
                'sub_menus.menu_id',
                'sub_menus.city_id',
                'sub_menus.description',
                'sub_menus.details'
            )
            ->get();

        return view('frontend.service-list', compact('submenus', 'subcategory', 'menus'));
    }
    public function servicesInIndia($city)
    {
        $faqs = Faq::where('status', 1)->select('question', 'answer')->get();
        $description = IndiaServiceDescription::first();
        $vendors = Vendor::where('status', 1)
            ->with('verified')
            ->whereHas('cityName', function ($query) use ($city) {
                $query->where('name', $city);
            })
            ->get();
        // $subcategory = Subcategory::where('status', 1)
        //     ->where('slug', $slug)
        //     ->first();
        return view('frontend.services-in-india-vendors', compact('faqs', 'vendors', 'description'));
    }

    public function servicesInIndiaCity($slug)
    {
        $states = State::where('country_id', 101)
            ->select('id', 'country_id', 'name', 'status')
            ->get();
        $faqs = Faq::where('status', 1)->select('question', 'answer')->get();
        $submenus = SubMenu::with(['subCategory', 'menu', 'cityName.state'])
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->select('id', 'name', 'image', 'slug', 'total_price', 'discounted_price', 'discount', 'subcategory_id', 'menu_id', 'city_id', 'description', 'details')
            ->get();
        $reviews = Review::where('status', 1)
            ->select('id', 'description', 'name', 'profession', 'status')
            ->get();
        $subcategory = Subcategory::where('status', 1)
            ->where('slug', $slug)
            ->first();
        $cities = City::select('id', 'name', 'state_id', 'status')
            ->where('status', 'active')
            ->paginate(10);

        // Use a subquery to directly filter vendors by city
        $vendors = Vendor::whereIn('city', function ($query) {
            $query->select('id')
                ->from('cities')
                ->where('status', 'active');
        })->first();

        $description = IndiaServiceDescription::where('sub_category_id', $subcategory->id ?? '')->first();
        return view('frontend.service-in-india', compact('faqs', 'submenus', 'description', 'reviews', 'subcategory', 'states', 'cities', 'vendors'));
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
            'email' => 'required|string|email|max:255',
            'date_time' => 'required|date',
            'move_from_origin' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Generate a random 4-digit OTP
        $otp = rand(1000, 9999);

        // Update the enquiry based on mobile number
        $enquiry = Enquiry::where('mobile_number', $request->mobile_number)->first();
        if ($enquiry) {
            $enquiry->name = $request->name;
            $enquiry->move_from_origin = $request->move_from_origin;
            $enquiry->email = $request->email;
            $enquiry->date_time = $request->date_time;
            $enquiry->subcategory_id = $request->subcategory_id;
            $enquiry->otp = $otp; // Store the generated OTP
            $enquiry->save();

            return response()->json(['success' => 'Details and OTP updated successfully']);
        }

        return response()->json(['error' => 'Enquiry not found'], 404);
    }

    public function verifyOtp(Request $request)
    {
        // Validate the OTP input
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|string',
            'otp' => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the enquiry by mobile number
        $enquiry = Enquiry::where('mobile_number', $request->mobile_number)->first();

        if ($enquiry) {
            // Check if the OTP matches and is not already verified
            if ($enquiry->otp == $request->otp && is_null($enquiry->otp_verified_at)) {
                // OTP is valid, update the verification time
                $enquiry->otp_verified_at = now();
                $enquiry->save();

                return response()->json(['success' => 'OTP verified successfully']);
            } elseif ($enquiry->otp_verified_at) {
                return response()->json(['error' => 'OTP has already been verified'], 400);
            }
        }

        return response()->json(['error' => 'Invalid OTP'], 400);
    }

    public function providerDetails($id)
    {
        $subcategories = Subcategory::where('status', 1)
            ->orderByDesc('created_at')
            ->get();
        $faqs = Faq::where('status', 1)->select('question', 'answer')->get();
        $vendor = Vendor::where('id', $id)->first();
        return view('frontend.vender-profile', compact('vendor', 'faqs', 'subcategories'));
    }

    public function reviewStore(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|max:15',
            'description' => 'required|string',
            'rating' => 'required',
        ]);

        // Store review logic here
        // Example:
        // return $request->all();
        Review::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'description' => $request->description,
            'rating' => $request->rating,
            'type' => 1,
        ]);

        // Return success response
        return response()->json(['success' => true, 'message' => 'Review submitted successfully!']);
    }

}
