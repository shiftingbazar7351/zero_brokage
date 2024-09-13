<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employee\Entities\EmployeeProduct;
use Modules\Employee\Entities\Companie;

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
    public function index()
    {
        $products = EmployeeProduct::orderByDesc('created_at')->paginate(10);
        $categories = Companie::get();  
        return view('employee::product.index',compact('products','categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([  
            'company_id'=> 'required',
            'name' => 'required|unique:employee_products|max:255',
            'image' => 'required',
        ]);


        $company = new EmployeeProduct();
        $company->name = $request->name;    
        $company->company_id = $request->company_id; 

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('image/', $request->file('image'));
            $company->image = $filename;
        }

        $company->save();

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
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
