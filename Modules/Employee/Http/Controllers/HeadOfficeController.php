<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\FileUploadService;
use Modules\Employee\Entities\HeadOffice;
use Illuminate\Validation\Rule;

class HeadOfficeController extends Controller
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
        $query = HeadOffice::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('number', 'like', '%' . $request->search . '%')
            ->orWhere('address', 'like', '%' . $request->search . '%');
        }
        // Paginate the users (adjust pagination number as needed)
        $offices = $query->orderByDesc('created_at')->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('employee::headoffice.partials.headoffice-index', compact('offices'))->render();
        }
        return view('employee::headoffice.index',compact('offices'));
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
            'name' => 'required|unique:head_offices|max:255',
            'image' => 'required',
            'number'=> 'required',
            'address'=> 'required'
        ]);


        $office = new HeadOffice();
        $office->name = $request->name;
        $office->number = $request->number;
        $office->address = $request->address;

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('employee/office/', $request->file('image'));
            $office->image = $filename;
        }

        $office->save();

        return response()->json(['success' => true, 'message' => 'office created successfully.']);
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $office = HeadOffice::find($id);
        return response()->json(['office' => $office]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        // Find the existing office record by ID
        $office = HeadOffice::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('head_offices')->ignore($office->id)
            ],
            'image' => 'nullable|image', // Add 'image' validation for better control
            'number'=> 'required',
            'address'=> 'required'
        ]);

        // Update the office with the new data
        $office->name = $request->name;
        $office->number = $request->number;
        $office->address = $request->address;

        // If a new image is uploaded, handle the file upload
        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('employee/office/', $request->file('image'));
            $office->image = $filename;
        }

        // Save the updated office data
        $office->save();

        // Return a JSON response indicating success
        return response()->json(['success' => true, 'message' => 'Office updated successfully.']);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $office = HeadOffice::findOrFail($id);
        $imageFields = [
            'image' => 'employee/office/',

        ];
        $office->delete();

        foreach ($imageFields as $field => $path) {
            $image = $office->$field; // Get the image name from the vendor object
            if ($image) {
                $this->fileUploadService->removeImage($path, $image);
            }
        }

        return redirect(route('employee-headoffice.index'))->with('success', ' Deleted Successfully!');
    }
}
