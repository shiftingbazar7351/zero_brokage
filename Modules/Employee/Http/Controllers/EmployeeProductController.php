<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employee\Entities\EmployeeProduct;
use Modules\Employee\Entities\Companie;
use Modules\Employee\Entities\HeadOffice;

use App\Services\FileUploadService;
use Illuminate\Validation\Rule;
use Exception;

class EmployeeProductController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = EmployeeProduct::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        // Paginate the users (adjust pagination number as needed)
        $products = $query->orderByDesc('created_at')->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('employee::product.partials.product-index', compact('products'))->render();
        }
        $companies = Companie::get();
        return view('employee::product.index', compact('products', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'name' => 'required|unique:employee_products|max:255',
            'image' => 'required',
        ]);


        $product = new EmployeeProduct();
        $product->company_id = $request->company_id;
        $product->name = $request->name;

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('employee/hoffice/', $request->file('image'));
            $product->image = $filename;
        }

        $product->save();

        return response()->json(['success' => true, 'message' => 'company created successfully.']);
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $products = EmployeeProduct::find($id);
        return response()->json(['product' => $products]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $product = EmployeeProduct::findOrFail($id);

        $request->validate([
            'company_id' => 'required',
            'name' => 'required',
            'image' => 'nullable',
        ]);


        $product->company_id = $request->company_id;
        $product->name = $request->name;

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('employee/hoffice/', $request->file('image'));
            $product->image = $filename;
        }

        $product->save();

        return response()->json(['success' => true, 'message' => 'company updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $hoffice = EmployeeProduct::findOrFail($id);
        $imageFields = [
            'image' => 'employee/hoffice/',

        ];
        $hoffice->delete();

        foreach ($imageFields as $field => $path) {
            $image = $hoffice->$field; // Get the image name from the vendor object
            if ($image) {
                $this->fileUploadService->removeImage($path, $image);
            }
        }

        return redirect(route('employee-product.index'))->with('success', ' Deleted Successfully!');
    }
}
