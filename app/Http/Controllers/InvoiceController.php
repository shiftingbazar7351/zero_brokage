<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Invoice;
use App\Models\State;
use App\Models\SubCategory;
use App\Models\SubMenu;
use App\Models\Transaction;
use App\Models\Vendor;
use App\Services\FileUploadService;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

    protected $fileUploadService;
    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    public function index(Request $request)
    {

        $query = Invoice::query();

        // Filter based on search query
        if ($request->has('search')) {
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                $q->where('total_ammount', 'like', '%' . $searchTerm . '%')
                    ->orWhere('quantity', 'like', '%' . $searchTerm . '%')
                    ->orWhere('grand_total', 'like', '%' . $searchTerm . '%')
                    ->orWhere('price', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('Category', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%'); // assuming 'name' is a column in 'createdBy' relationship
                    })
                    ->orWhereHas('subCategory', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%'); // assuming 'name' is a column in 'createdBy' relationship
                    })
                    ->orWhereHas('menu', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%'); // assuming 'name' is a column in 'createdBy' relationship
                    })
                    ->orWhereHas('submenu', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%'); // assuming 'name' is a column in 'createdBy' relationship
                    });
            })->orderByDesc('created_at');
        }

        // Paginate the users (adjust pagination number as needed)
        $invoices = $query->paginate(10);

        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('backend.invoice.partials.invoice-index', compact('invoices'))->render();
        }
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        $countryId = Country::where('name', 'India')->value('id');
        $invoicesname = Invoice::with(['Category', 'cityName', 'subcategory', 'menu', 'submenu'])->get();
        $states = State::where('country_id', $countryId)->get(['name', 'id']);
        // $invoices = Invoice::orderByDesc('created_at')->paginate(10);
        $vendors = Vendor::select('id', 'vendor_name')->orderByDesc('created_at')->get();
        $vendor = Vendor::select('id', 'vendor_name')->first();
        return view('backend.invoice.index', compact('vendors', 'vendor', 'invoicesname', 'invoices', 'categories', 'subcategories', 'submenus', 'countryId', 'states'));
    }

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
            'quantity' => 'required|integer',
            'total_ammount' => 'required|numeric',
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

        // Store the invoice in the session
        Session::put('new_invoice', $invoice);
        // Session::flash('success', 'Added Successfully');
        return redirect()->back()->with(['message' => 'Added Successfully', 'alert-type' => 'success']);
    }

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
        $invoicesname = Invoice::with(['Category', 'cityName', 'subcategory', 'menu', 'submenu'])->get();
        $states = State::where('country_id', $countryId)->get(['name', 'id']);
        $invoices = Invoice::orderByDesc('created_at')->paginate(10);
        $transactions = Transaction::select('id', 'transaction_id', 'utr', 'screenshot', 'payment_time')->get();
        $vendor = Vendor::findOrFail($id);
        return view('backend.invoice.create', compact('transactions', 'vendor', 'invoicesname', 'invoices', 'categories', 'subcategories', 'submenus', 'countryId', 'states'));
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
        return redirect(route('invoice.edit', $vendor->id ?? ''))->with(['message' => 'Updated Successfully', 'alert-type' => 'success']);
        ;
        // return redirect(route('invoice.create'))->with('success', 'Invoice added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $invoices = Invoice::findOrFail($id);
        if ($invoices) {
            $invoices->delete();
            return redirect()->back()->with(['message' => 'Deleted Successfully', 'alert-type' => 'success']);
            ;
        }
        return redirect()->back()->with(['message' => 'Something went wrong', 'alert-type' => 'error']);
        ;
    }

    public function generatePDF()
    {
        $data = ['title' => 'Laravel PDF Example', 'date' => date('m/d/Y')];

        $pdf = PDF::loadView('frontend.reciept', $data);

        return $pdf->download('invoice.pdf');
    }

    public function dataStore(Request $request, $id)
    {
        // Validate the request
        // $request->validate([
        //     'company_name' => 'required',
        //     'location_lat' => 'required',
        //     'whatsapp' => 'required',
        //     'number' => 'required',
        //     'email' => 'required|email',
        //     'address' => 'required',
        //     'transaction_id' => 'required|array', // Ensure transaction_id is an array
        //     'transaction_id.*' => 'exists:transactions,id' // Each selected transaction must exist
        // ]);



        $vendor = Vendor::findOrFail($id);
        $vendor->company_name = $request->company_name;
        $vendor->location_lat = $request->location_lat;
        $vendor->whatsapp = $request->whatsapp;
        $vendor->number = $request->number;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->invoice_number = $request->rand('SBZ1508' + rand(999999));


        $transactionIds = $request->input('transaction_id');
        $utrs = $request->input('utr');
        $paymentDates = $request->input('payment_date');
        $screenshots = $request->file('screenshot');

        foreach ($transactionIds as $index => $tranId) {
            $transaction = Transaction::find($tranId);
            if ($transaction) {
                // Check if UTR and payment date exist before accessing
                if (isset($utrs[$index])) {
                    $transaction->utr = $utrs[$index];
                }

                if (isset($paymentDates[$index])) {
                    $transaction->payment_date = $paymentDates[$index];
                }

                // Handle screenshot upload if the file exists for the specific transaction
                if ($request->hasFile("screenshot.{$index}")) {
                    // Use your fileUploadService to upload the screenshot
                    $filename = $this->fileUploadService->uploadImage('transaction/', $screenshots[$index]);
                    $transaction->screenshot = $filename;
                }
                $transaction->save();
            }
        }

        // Redirect back with a success message
        return redirect(route('generate.pdf'))->with('success', 'Vendor and transactions updated successfully.');
    }

    public function reciept($id)
    {
        $vendor = Vendor::find($id);
        return view('frontend.reciept', compact('vendor'));
    }

}
