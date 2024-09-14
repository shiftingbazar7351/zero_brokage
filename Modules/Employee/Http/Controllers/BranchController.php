<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Employee\Entities\EmployeeProduct;
use Modules\Employee\Entities\Branch;

use App\Services\FileUploadService;
use Illuminate\Validation\Rule;
use Exception;

class BranchController extends Controller
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
        $Branchs = Branch::orderByDesc('created_at')->paginate(10);
        $products = EmployeeProduct::get();
        return view('employee::branch.index',compact('Branchs','products'));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'image' => 'required',
        ]);

        $product = new Branch();
        $product->product_id = $request->product_id;
        $product->name = $request->name;
        $product->address = $request->address;

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('employee/branch/', $request->file('image'));
            $product->image = $filename;
        }

        $product->save();

        return response()->json(['success' => true, 'message' => 'Branch created successfully.']);
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $branchs = Branch::find($id);
        return response()->json(['branch' => $branchs]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $branch = Branch::find($id);
        $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'image' => 'nullable',
        ]);

        $branch->product_id = $request->product_id;
        $branch->name = $request->name;
        $branch->address = $request->address;

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('employee/branch/', $request->file('image'));
            $branch->image = $filename;
        }

        $branch->save();

        return response()->json(['success' => true, 'message' => 'Branch updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $Branch = Branch::findOrFail($id);
        $imageFields = [
            'image' => 'employee/Branch/',

        ];
        $Branch->delete();

        foreach ($imageFields as $field => $path) {
            $image = $Branch->$field; // Get the image name from the vendor object
            if ($image) {
                $this->fileUploadService->removeImage($path, $image);
            }
        }

        return redirect(route('employee-branch.index'))->with('success', ' Deleted Successfully!');
    }
}
