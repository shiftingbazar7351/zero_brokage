<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

use Modules\Employee\Entities\Companie;
use Modules\Employee\Entities\HeadOffice;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\FileUploadService;
use Validator;

class CompanyController extends Controller
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
        $companies = Companie::orderByDesc('created_at')->paginate(10);
        $offices = HeadOffice::orderByDesc('created_at')->paginate(10);
        return view('employee::company.index', compact('companies','offices'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('employee::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:companies|max:255',
            'legel_name' => 'required',
            'hoffice_id'=> 'required',
            'image' => 'required'
        ]);


        $company = new Companie();
        $company->brand_name = $request->brand_name;
        $company->legel_name = $request->legel_name;
        $company->hoffice_id = $request->hoffice_id;

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('employee/company/', $request->file('image'));
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
        $company = Companie::find($id);
        return response()->json(['company' => $company]);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $company = Companie::findOrFail($id);

        $request->validate([
            'brand_name' => 'required|string|max:255',
            'legel_name' => 'required',
            'hoffice_id'=> 'required',
            'image' => 'nullable',
        ]);

        $company->brand_name = $request->brand_name;
        $company->legel_name = $request->legel_name;
        $company->hoffice_id = $request->hoffice_id;

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('image/', $request->file('image'));
            $company->image = $filename;
        }
        $company->save();

        return response()->json(['success' => true, 'message' => 'Company updated successfully']);

    }

    /**
     * Remove the specified company from storage.
     */
    public function destroy($id)
    {
        $company = Companie::findOrFail($id);
        $imageFields = [
            'image' => 'employee/company/',

        ];
        $company->delete();

        foreach ($imageFields as $field => $path) {
            $image = $company->$field; // Get the image name from the vendor object
            if ($image) {
                $this->fileUploadService->removeImage($path, $image);
            }
        }

        return redirect(route('employee-company.index'))->with('success', ' Deleted Successfully!');

    }
}
