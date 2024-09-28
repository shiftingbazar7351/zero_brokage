<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Employee\Entities\Department;
use Modules\Employee\Entities\Branch;

use App\Services\FileUploadService;
use Illuminate\Validation\Rule;
use Exception;
class DepartmentController extends Controller
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
        $query = Department::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('department_id', 'like', '%' . $request->search . '%');
            $query->where('designation_id', 'like', '%' . $request->search . '%');
            // $query->where('address', 'like', '%' . $request->search . '%');
        }
        // Paginate the users (adjust pagination number as needed)
        $departments = $query->orderByDesc('created_at')->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('employee::department.partials.department-index', compact('departments'))->render();
        }
        $branchs = Branch::get();
        return view('employee::department.index',compact('departments','branchs'));
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
        // Validate the input data
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'department_id' => 'required',
            'designation_id' => 'required',
            'sub_designation_id' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png,pdf|max:2048', // Allow images or PDFs
        ]);

        $department = new Department();
        $department->branch_id = $request->branch_id;
        $department->department_id = $request->department_id;
        $department->designation_id = $request->designation_id;
        $department->sub_designation_id = $request->sub_designation_id;
        // $department->address = $request->address;

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('employee/departments/', $request->file('image'));
            $department->image = $filename;
        }

        $department->save();
        return response()->json(['success' => true, 'message' => 'Department created successfully!.']);
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $department = Department::find($id);
        return response()->json(['department' => $department]);
    }
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $department =  Department::findOrFail($id);
        $request->validate([
            'branch_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'sub_designation_id' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png,pdf|max:2048', // Allow images or PDFs
        ]);

        $department->branch_id = $request->branch_id;
        $department->department_id = $request->department_id;
        $department->designation_id = $request->designation_id;
        $department->sub_designation_id = $request->sub_designation_id;
        // $department->address = $request->address;

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('employee/departments/', $request->file('image'));
            $department->image = $filename;
        }

        $department->save();
        return response()->json(['success' => true, 'message' => 'Department updated successfully!.']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $imageFields = [
            'image' => 'employee/departments/',

        ];
        $department->delete();

        foreach ($imageFields as $field => $path) {
            $image = $department->$field; // Get the image name from the vendor object
            if ($image) {
                $this->fileUploadService->removeImage($path, $image);
            }
        }

        return redirect(route('employee-department.index'))->with('success', ' Deleted Successfully!');
    }

    public function DepartmentStatus(Request $request)
    {
        $item = Department::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();
            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }
}
