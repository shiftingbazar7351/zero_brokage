<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\SubMenu;
use App\Models\SubCategory;
use App\Services\FileUploadService;

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
        return view("backend.vendor.index" , compact('subcategories','submenus','vendors') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        return view("backend.vendor.create" , compact('subcategories','submenus'));
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
            'sub_category' => 'required|string|max:255',
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
            'verified' => 'required|integer',
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
        $vendor = Vendor::create( $validatedData);

        if ($request->hasFile('vendor_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/', $request->file('vendor_image'));
            $vendor->vendor_image = $filename;
        }

        if ($request->hasFile('gst_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/', $request->file('gst_image'));
            $vendor->gst_image = $filename;
        }

        if ($request->hasFile('pan_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/', $request->file('pan_image'));
            $vendor->pan_image = $filename;
        }
        if ($request->hasFile('adhar_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/', $request->file('adhar_image'));
            $vendor->adhar_image = $filename;
        }
        if ($request->hasFile('visiting_card')) {
            $filename = $this->fileUploadService->uploadImage('vendor/', $request->file('visiting_card'));
            $vendor->visiting_card = $filename;
        }
        if ($request->hasFile('client_sign')) {
            $filename = $this->fileUploadService->uploadImage('vendor/', $request->file('client_sign'));
            $vendor->client_sign = $filename;
        }
        

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $vendor = Vendor::findOrFail($id); // Find the vendor by ID or fail if not found
    $subcategories = SubCategory::orderByDesc('created_at')->get();
    $submenus = SubMenu::orderByDesc('created_at')->get();
    return view('backend.vendor.edit', compact('vendor', 'subcategories', 'submenus')); // Pass the vendor data to the view
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
            $filename = $this->fileUploadService->uploadImage('vendor/', $request->file('vendor_image'));
            $vendor->vendor_image = $filename;
        }
    
        if ($request->hasFile('gst_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/', $request->file('gst_image'));
            $vendor->gst_image = $filename;
        }
    
        if ($request->hasFile('pan_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/', $request->file('pan_image'));
            $vendor->pan_image = $filename;
        }
    
        if ($request->hasFile('adhar_image')) {
            $filename = $this->fileUploadService->uploadImage('vendor/', $request->file('adhar_image'));
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
        $vendor = Vendor::findOrFail($id); // Find the vendor by ID or fail if not found
        $vendor->delete(); // Delete the vendor

        return redirect(route('vendors.index'))->with('success', 'Vendor Deleted Successfully!');
    }

}
