<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\Menu;
use App\Models\SubCategory;
use App\Models\SubMenu;
use App\Models\Vendor;
use App\Models\Verified;
use App\Services\FileUploadService;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class VendorController extends Controller
{

    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        $vendors = Vendor::orderByDesc('created_at')->paginate(10);
        return view("backend.vendor.index", compact('subcategories', 'submenus', 'vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        $countryId = Country::where('name', 'India')->value('id');
        $verifieds = Verified::orderByDesc('created_at')->get();
        $states = State::where('country_id', $countryId)->get(['name', 'id']);
        return view("backend.vendor.create", compact('subcategories', 'submenus', 'states', 'categories', 'verifieds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'manager_id' => 'required|integer',
            'employee_id' => 'required|integer',
            'category' => 'required|max:255',
            'sub_category' => 'required|max:255',
            'menu_id' => 'required|max:255',
            'submenu_id' => 'required|max:255',
            'company_name' => 'required|string|max:255',
            'legal_company_name' => '|string|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'pincode' => 'required|max:6',
            'address' => 'required|string|max:500',
            'email' => 'required|email',
            'whatsapp' => 'nullable|max:10',
            'number' => 'required|max:10',
            // 'website' => 'nullable|url',
            // 'verified' => 'required',
            // 'submenu_id' => 'required|integer',
            // 'description' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'owner_name' => 'required|string|max:255',
            'vendor_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gst_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gst_number' => 'required|max:15',
            'pan_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pan_number' => 'required|max:10',
            'adhar_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'adhar_numbere' => 'required|max:12',
            // 'visiting_card' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'client_sign' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //    'video' => 'required|file|mimetypes:video/mp4,video/x-m4v|max:51200', // Max 50MB
            // 'location_lat' => 'nullable|numeric',
            // 'location_lang' => 'nullable|numeric',
        ]);
        // return $request->all();

        // Save vendor data
        // Create the vendor record

        $vendor = Vendor::create($request->all());

        $vendor->created_by = auth()->user()->id;
        $vendor->otp = Session::get('otp');
        // $vendor->otp_verified_at = Session::get('otp_verified_at');

        // Check if the request has any image files and update the vendor model
        if ($request->hasFile('logo')) {
            $filename = $this->fileUploadService->uploadImage('vendor/logo/', $request->file('logo'));
            $vendor->logo = $filename;
        }

        if ($request->hasFile('vendor_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/vendor_image/', $request->file('vendor_image'));
            $vendor->vendor_image = $filename;
        }

        if ($request->hasFile('gst_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/gst_image/', $request->file('gst_image'));
            $vendor->gst_image = $filename;
        }

        if ($request->hasFile('pan_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/pan_image/', $request->file('pan_image'));
            $vendor->pan_image = $filename;
        }

        if ($request->hasFile('adhar_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/adhar_image/', $request->file('adhar_image'));
            $vendor->adhar_image = $filename;
        }

        if ($request->hasFile('visiting_card')) {
            $filename = $this->fileUploadService->uploadImage('vendor/visiting_card/', $request->file('visiting_card'));
            $vendor->visiting_card = $filename;
        }

        if ($request->hasFile('client_sign')) {
            $filename = $this->fileUploadService->uploadImage('vendor/client_sign/', $request->file('client_sign'));
            $vendor->client_sign = $filename;
        }

        if ($request->hasFile('video')) {
            $filename = $this->fileUploadService->uploadImage('vendor/video/', $request->file('video'));
            $vendor->video = $filename;
        }


        // return $vendor;
        // Save the vendor model with the updated image fields
        $vendor->save();

        return redirect(route('vendors.index'))->with('success', 'Vendor Created Successfully!');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view("backend.vendor.show", compact('vendor', ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $countryId = Country::where('name', 'India')->value('id');
        $states = State::where('country_id', $countryId)->get(['name', 'id']);
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $vendor = Vendor::findOrFail($id); // Find the vendor by ID or fail if not found
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        $verifieds = Verified::orderByDesc('created_at')->get();
        return view('backend.vendor.edit', compact('vendor', 'subcategories', 'submenus', 'categories', 'states', 'verifieds')); // Pass the vendor data to the view
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'manager_id' => 'required|integer',
            'employee_id' => 'required|integer',
            'category' => 'required|max:255',
            'sub_category' => 'required|max:255',
            'menu_id' => 'required|max:255',
            'submenu_id' => 'required|max:255',
            'company_name' => 'required|string|max:255',
            'legal_company_name' => '|string|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'pincode' => 'required|max:6',
            'address' => 'required|string|max:500',
            'email' => 'required|email',
            'whatsapp' => 'nullable|max:10',
            'number' => 'required|max:10',
            // 'website' => 'nullable|url',
            // 'verified' => 'required',
            // 'submenu_id' => 'required|integer',
            // 'description' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'owner_name' => 'required|string|max:255',
            'vendor_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gst_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gst_number' => 'required|max:15',
            'pan_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pan_number' => 'required|max:10',
            'adhar_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'adhar_numbere' => 'required|max:12',
            // 'visiting_card' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'client_sign' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //    'video' => 'required|file|mimetypes:video/mp4,video/x-m4v|max:51200', // Max 50MB
            // 'location_lat' => 'nullable|numeric',
            // 'location_lang' => 'nullable|numeric',
        ]);

        $vendor = Vendor::findOrFail($id); // Find the vendor by ID or fail if not found
        $vendor->update($validatedData); // Update the vendor data
        // return $vendor;

        // Handle file uploads
        if ($request->hasFile('logo')) {
            $filename = $this->fileUploadService->uploadImage('vendor/logo/', $request->file('logo'));
            $vendor->logo = $filename;
        }

        if ($request->hasFile('vendor_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/vendor_image/', $request->file('vendor_image'));
            $vendor->vendor_image = $filename;
        }

        if ($request->hasFile('gst_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/gst_image/', $request->file('gst_image'));
            $vendor->gst_image = $filename;
        }

        if ($request->hasFile('pan_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/pan_image/', $request->file('pan_image'));
            $vendor->pan_image = $filename;
        }

        if ($request->hasFile('adhar_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/adhar_image/', $request->file('adhar_image'));
            $vendor->adhar_image = $filename;
        }

        if ($request->hasFile('video')) {
            $filename = $this->fileUploadService->uploadImage('vendor/video/', $request->file('video'));
            $vendor->video = $filename;
        }

        $vendor->save(); // Save the changes

        return redirect(route('vendors.index'))->with('success', 'Vendor Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        try {
            $vendor = Vendor::findOrFail($id);

            // Collect image fields with their respective paths
            $imageFields = [
                'vendor_image' => 'vendor/vendor_image/',
                'gst_image' => 'vendor/gst_image/',
                'pan_image' => 'vendor/pan_image/',
                'adhar_image' => 'vendor/adhar_image/',
                'visiting_card' => 'vendor/visiting_card/',
                'client_sign' => 'vendor/client_sign/'
            ];

            // Delete the vendor
            $vendor->delete();

            // Remove associated images
            foreach ($imageFields as $field => $path) {
                $image = $vendor->$field; // Get the image name from the vendor object
                if ($image) {
                    $this->fileUploadService->removeImage($path, $image);
                }
            }

            return redirect(route('vendors.index'))->with('success', 'Vendor Deleted Successfully!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function fetchCity($stateId)
    {
        $cities = City::where('state_id', $stateId)->get()->map(function ($city) {
            $city->name = ucwords($city->name);
            return $city;
        });
        if ($cities->isEmpty()) {
            return response()->json(['status' => 0, 'message' => 'No cities found']);
        }
        return response()->json(['status' => 1, 'data' => $cities]);
    }


    public function fetchSubcategory(Request $request)
    {
        $categoryIds = $request->category_ids;
    
        if (!empty($categoryIds)) {
            // Fetch subcategories that belong to the selected categories
            $subcategories = SubCategory::whereIn('category_id', $categoryIds)->get();
    
            return response()->json([
                'status' => 1,
                'data' => [
                    'categories' => Category::whereIn('id', $categoryIds)->get(), // Return the selected categories
                    'subcategories' => $subcategories,
                ],
            ]);
        }
    
        return response()->json([
            'status' => 0,
            'data' => [],
            'message' => 'No categories selected',
        ]);
    }
    
    // Similarly for fetching menus and submenus
    public function fetchSubMenu(Request $request)
    {
        $menuIds = $request->menu_ids;
    
        // Fetch menus based on the selected menu IDs
        $menus = Menu::whereIn('id', $menuIds)->get();
    
        // Fetch submenus related to the selected menus
        $submenus = SubMenu::whereIn('menu_id', $menuIds)->get();
    
        // Return response
        if ($submenus->isEmpty()) {
            return response()->json(['status' => 0, 'data' => ['menus' => $menus, 'submenus' => []]]);
        }
    
        return response()->json(['status' => 1, 'data' => ['menus' => $menus, 'submenus' => $submenus]]);
    }
    

        public function fetchMenu(Request $request)
    {
        $subcategoryIds = $request->subcategory_ids;

        // Fetch menus based on the selected subcategory IDs
        $menus = Menu::whereIn('subcategory_id', $subcategoryIds)->get();

        if ($menus->isEmpty()) {
            return response()->json(['status' => 0, 'data' => []]);
        }

        return response()->json(['status' => 1, 'data' => $menus]);
    }

    

    public function getMenus(Request $request, $subcategoryId)
    {
        $menus = Menu::where('subcategory_id', $subcategoryId)->get();
        return response()->json([
            'status' => 1,
            'data' => $menus
        ]);
    }

    public function getsubMenus(Request $request, $menuId)
    {
        $submenus = SubMenu::where('menu_id', $menuId)->get();
        return response()->json([
            'status' => 1,
            'data' => $submenus
        ]);
    }
    public function sendOtp(Request $request)
    {
        $request->validate([
            'number' => 'required|digits:10',
        ]);

        $otp = rand(1000, 9999); // Generate a 4-digit OTP
        Session::put('otp', $otp); // Store OTP in the session
        Session::put('number', $request->number); // Store OTP in the session

        // Logic to send OTP to the phone number (using an SMS API or any service)

        return response()->json(['message' => 'OTP sent successfully.', 'otp' => $otp]);
    }

    // Method to verify OTP
    public function verifyOtp(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'otp' => 'required|digits:4',
                'mobile_number' => 'required|digits:10',
            ]);

            // Retrieve the OTP from the session
            $storedOtp = Session::get('otp');

            // Match the OTP with the one stored in session
            if ($request->otp == $storedOtp) {
                // Store the OTP verified time in the session
                Session::put('otp_verified_at', now());

                return response()->json(['message' => 'OTP verified successfully.']);
            } else {
                return response()->json(['message' => 'Invalid OTP.'], 400);
            }
        } catch (Exception $e) {
            // Log the error for debugging
            Log::error('OTP verification failed: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred. Please try again.'], 500);
        }
    }

}
