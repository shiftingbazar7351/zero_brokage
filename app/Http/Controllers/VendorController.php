<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Menu;
use App\Models\SubCategory;
use App\Models\SubMenu;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Vendor;
use App\Services\FileUploadService;

use Exception;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        $vendors = Vendor::orderByDesc('created_at')->get();
     
        return view("backend.vendor.index", compact('subcategories', 'submenus', 'vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        $countryId = Country::where('name', 'India')->value('id');
        $states = State::where('country_id', $countryId)->get(['name', 'id']);
        return view("backend.vendor.create", compact('subcategories', 'submenus', 'states','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $validatedData = $request->validate([
            'manager_id' => 'required|integer',
            'employee_id' => 'required|integer',
            'category' => 'required|string|max:255',
            'sub_category' => 'required|string|max:255',
            'menu_id' => 'required|string|max:255',
            'submenu_id' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'legal_company_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|string|max:6',
            'address' => 'required|string|max:500',
            'email' => 'required|email',
            // 'whatsapp' => 'nullable|string|max:10',
            // 'number' => 'required|string|max:10',
            'website' => 'nullable|url',
            // 'verified' => 'required|integer',
            // 'submenu_id' => 'required|integer',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'owner_name' => 'required|string|max:255',
            'vendor_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gst_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gst_number' => 'required|string|max:15',
            'pan_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pan_number' => 'required|string|max:10',
            'adhar_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'adhar_numbere' => 'required|string|max:12',
            // 'visiting_card' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'client_sign' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg|max:10000',
            // 'location_lat' => 'nullable|numeric',
            // 'location_lang' => 'nullable|numeric',
        ]);
        // return $request->all();

        // Save vendor data
        // Create the vendor record
        
        $vendor = Vendor::create($validatedData);
        // return $vendor;
        $vendor->created_by = auth()->user()->id;

        // Check if the request has any image files and update the vendor model
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

        // Save the vendor model with the updated image fields
        $vendor->save();

        return redirect(route('vendors.index'))->with('success', 'Vendor Created Successfully!');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendors = Vendor::orderByDesc('created_at')->get();
        return view("backend.vendor.show",compact('vendors',));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countryId = Country::where('name', 'India')->value('id');
        $states = State::where('country_id', $countryId)->get(['name', 'id']);
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $vendor = Vendor::findOrFail($id); // Find the vendor by ID or fail if not found
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        return view('backend.vendor.edit', compact('vendor', 'subcategories', 'submenus','categories','states')); // Pass the vendor data to the view
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'manager_id' => 'required',
            'employee_id' => 'required',
            // 'sub_category' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'legal_company_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|string|max:6',
            'address' => 'required|string|max:500',
            'email' => 'required|email',
            'website' => 'nullable|url',
            'verified' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'owner_name' => 'required|string|max:255',
            'vendor_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gst_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gst_number' => 'required|string|max:15',
            'pan_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pan_number' => 'required|string|max:10',
            'adhar_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $vendor = Vendor::findOrFail($id); // Find the vendor by ID or fail if not found
        $vendor->update($validatedData); // Update the vendor data
        // return $vendor;

        // Handle file uploads
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

        $vendor->save(); // Save the changes

        return redirect(route('vendors.index'))->with('success', 'Vendor Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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


    public function fetchsubcategory($category_id = null)
    {
        $data = SubCategory::where('category_id', $category_id)->get();
        return response()->json([
            'status' => 1,
            'data' => $data,
        ]);
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



}
