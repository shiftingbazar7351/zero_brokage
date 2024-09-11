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
use App\Services\FileUploadService;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        $countryId = Country::where('name', 'India')->value('id');
        $invoicesname = Invoice::with(['Category', 'cityName', 'stateName', 'subcategory', 'menu', 'submenu'])->get();
        $states = State::where('country_id', $countryId)->get(['name', 'id']);
        $invoices = Invoice::orderByDesc('created_at')->paginate(10);
        $vendors = Vendor::select('id', 'vendor_name')->orderByDesc('created_at')->get();
        $vendor = Vendor::select('id', 'vendor_name')->first();
        return view('backend.invoice.index', compact('vendors', 'vendor', 'invoicesname', 'invoices', 'categories', 'subcategories', 'submenus', 'countryId', 'states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    // public function create($id)
    // {
    //     $vendor = Vendor::where('id',$id)->first();
    //     return view('backend.invoice.create',compact('vendor'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'menu_id' => 'required|exists:menus,id',
            'submenu_id' => 'required|exists:sub_menus,id',
            'price' => 'required|numeric',
            // 'hsn' => 'required|max:50',
            // 'product_id' => 'required',
            'quantity' => 'required|integer',
            'total_ammount' => 'required|numeric',
            // 'gst' => 'required|integer|min:0|max:100',
            'grand_total' => 'required|numeric',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
        ]);

        // Storing the data
        $invoice = new Invoice();
        $invoice->category_id = $request->category_id;
        $invoice->subcategory_id = $request->subcategory_id;
        $invoice->menu_id = $request->menu_id;
        $invoice->submenu_id = $request->submenu_id;
        $invoice->product_id = $request->product_id;
        $invoice->hsn = $request->hsn;
        $invoice->price = $request->price;
        $invoice->quantity = $request->quantity;
        $invoice->total_ammount = $request->total_ammount;
        $invoice->gst = $request->gst;
        $invoice->grand_total = $request->grand_total;
        $invoice->state = $request->state;
        $invoice->city = $request->city;
        $invoice->save();

        return redirect(route('invoice.create'))->with('success', 'Invoice added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    // public function show($id)
    // {
    //    return $invoice = Invoice::findOrFail($id);
    //     return view("backend.invoice.index", compact('invoice', ));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        $countryId = Country::where('name', 'India')->value('id');
        $invoicesname = Invoice::with(['Category', 'cityName', 'stateName', 'subcategory', 'menu', 'submenu'])->get();
        $states = State::where('country_id', $countryId)->get(['name', 'id']);
        $invoices = Invoice::orderByDesc('created_at')->paginate(10);
        $vendor = Vendor::findOrFail($id);
        return view('backend.invoice.create', compact( 'vendor', 'invoicesname', 'invoices', 'categories', 'subcategories', 'submenus', 'countryId', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {

        $vendorId = $request->input('vendor_id', $id);
        $vendor = Vendor::findOrFail($vendorId);
        return redirect(route('invoice.edit', $vendor->id ?? ''));

        // return redirect(route('invoice.create'))->with('success', 'Invoice added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        //
    }
}
