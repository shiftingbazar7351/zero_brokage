<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorTask;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Employee\Entities\Employees;

class TaskController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $query = VendorTask::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('note', 'like', '%' . $request->search . '%')
                ->orWhere('comments', 'like', '%' . $request->search . '%')
                ->orWhere('tags', 'like', '%' . $request->search . '%')
                ->orWhere('client_type', 'like', '%' . $request->search . '%')
                ->orWhere('status', 'like', '%' . $request->search . '%')
                ->orderByDesc('created_at');
        }
        // Paginate the users (adjust pagination number as needed)
        $tasks = $query->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('backend.vendor.task.partials.task-index', compact('tasks'))->render();
        }
        return view('backend.vendor.task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $employees = User::where('employee_code', '!=', null)->select('id', 'name', 'lname')->get();
        return view('backend.vendor.task.create', compact('categories', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'company_name' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'menu_id' => 'required',
            'submenu_id' => 'required',
            'email' => 'required|email',
            'number' => 'required',
            'employee_id' => 'required',
            'comments' => 'required|string|max:255',
            'vendor_id' => 'nullable|string|max:255', // This field is nullable in case it's not filled
            'note' => 'required|string|max:255',
            'next_followup_date_time' => 'required|date',
            'tags' => 'required|string|max:255',
            'call_record' => 'required|file|mimes:mp3,wav|max:3072', // 3 MB max for call record
            'call_history_img' => 'required|image|max:2048', // 2 MB max for image
            'client_type' => 'required|in:NC,EC,DC',
            'status' => 'required|in:in_progress,cancelled,on_hold,completed,pending',
        ]);

        // Handle file uploads
        $callRecordPath = null;
        if ($request->hasFile('call_record')) {
            $callRecordFile = $request->file('call_record');
            if ($callRecordFile->isValid()) {
                $callRecordPath = $this->fileUploadService->uploadImage('call_records/', $callRecordFile);
            } else {
                return redirect()->back()->withErrors(['call_record' => 'The uploaded file is not valid.']);
            }
        }

        $callHistoryImagePath = null;
        if ($request->hasFile('call_history_img')) {
            $callHistoryImagePath = $this->fileUploadService->uploadImage('call_history_images/', $request->file('call_history_img'));
        }

        // Create a new vendor task
        $vendorTask = VendorTask::create([
            'vendor_id' => $request->input('vendor_id'), // Store the vendor_id
            'comments' => $request->input('comments'),
            'note' => $request->input('note'),
            'next_followup_date_time' => $request->input('next_followup_date_time'),
            'tags' => $request->input('tags'),
            'call_record' => $callRecordPath,
            'call_history_img' => $callHistoryImagePath,
            'client_type' => $request->input('client_type'),
            'employee_id' => $request->input('employee_id'),
            'status' => $request->input('status'),
            'created_by' => auth()->user()->id,
        ]);

        // Optionally, update vendor information if necessary
        if ($request->filled('vendor_id')) {
            $vendor = Vendor::find($request->input('vendor_id'));
            if ($vendor) {
                $vendor->update([
                    'company_name' => $request->input('company_name'),
                    'email' => $request->input('email'),
                    'number' => $request->input('number'),
                    'address' => $request->input('address'),
                    // Add other fields as needed
                ]);
            }
        }

        return redirect()->route('vendor-task.index')->with(['message' => 'Vendor Task created successfully.', 'alert-type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $task = VendorTask::findOrFail($id);
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $employees = User::where('employee_code', '!=', null)->select('id', 'name', 'lname')->get();
        return view('backend.vendor.task.edit', compact('task', 'categories', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'company_name' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'menu_id' => 'required',
            'submenu_id' => 'required',
            'email' => 'required|email',
            'number' => 'required',
            'employee_id' => 'required',
            'comments' => 'required|string|max:255',
            'vendor_id' => 'nullable|string|max:255', // This field is nullable in case it's not filled
            'note' => 'required|string|max:255',
            'next_followup_date_time' => 'required|date',
            'tags' => 'required|string|max:255',
            'call_record' => 'nullable|file|mimes:mp3,wav|max:3072', // 3 MB max for call record
            'call_history_img' => 'nullable|image|max:2048', // 2 MB max for image
            'client_type' => 'required|in:NC,EC,DC',
            'status' => 'required|in:in_progress,cancelled,on_hold,completed,pending',
        ]);

        // Handle file uploads
        $callRecordPath = null;
        if ($request->hasFile('call_record')) {
            $callRecordFile = $request->file('call_record');
            if ($callRecordFile->isValid()) {
                $callRecordPath = $this->fileUploadService->uploadImage('call_records/', $callRecordFile);
            } else {
                return redirect()->back()->withErrors(['call_record' => 'The uploaded file is not valid.']);
            }
        }

        $callHistoryImagePath = null;
        if ($request->hasFile('call_history_img')) {
            $callHistoryImagePath = $this->fileUploadService->uploadImage('call_history_images/', $request->file('call_history_img'));
        }

        // Create a new vendor task
        $vendorTask = VendorTask::create([
            'vendor_id' => $request->input('vendor_id'), // Store the vendor_id
            'comments' => $request->input('comments'),
            'note' => $request->input('note'),
            'next_followup_date_time' => $request->input('next_followup_date_time'),
            'tags' => $request->input('tags'),
            'call_record' => $callRecordPath,
            'call_history_img' => $callHistoryImagePath,
            'client_type' => $request->input('client_type'),
            'employee_id' => $request->input('employee_id'),
            'status' => $request->input('status'),
            'created_by' => auth()->user()->id,
        ]);

        // Optionally, update vendor information if necessary
        if ($request->filled('vendor_id')) {
            $vendor = Vendor::find($request->input('vendor_id'));
            if ($vendor) {
                $vendor->update([
                    'company_name' => $request->input('company_name'),
                    'email' => $request->input('email'),
                    'number' => $request->input('number'),
                    'address' => $request->input('address'),
                    // Add other fields as needed
                ]);
            }
        }


        return redirect()->route('vendor-task.index')->with(['message' => 'Vendor Task created successfully.', 'alert-type' => 'success']);
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

    public function fetchVendorData(Request $request)
    {
        // Search based on submenu_id
        $vendor = Vendor::where('submenu_id', $request->submenu_id)->first();

        if ($vendor) {
            return response()->json([
                'success' => true,
                'vendor' => $vendor
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No vendor found'
            ]);
        }
    }

    public function vendorTaskStatus(Request $request)
    {
        $item = VendorTask::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }

}
