<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Vendor;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        return view('backend.vendor.task.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'comments' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
            'next_followup_date' => 'nullable|date',
            'next_followup_time' => 'nullable',
            'next_followup_am_pm' => 'nullable|in:AM,PM',
            'tags' => 'nullable|string|max:255',
            // 'call_record' => 'nullable|file|mimes:mp3,wav', // You can customize the allowed file types
            // 'call_history_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
            'client_type' => 'required|in:new,existing',
            'task_status' => 'required|in:pending,completed,in-progress',
        ]);

        // Handle file uploads (if any)
        $callRecordPath = null;
        if ($request->hasFile('call_record')) {
            $callRecordPath = $request->file('call_record')->store('call_records', 'public');
        }

        $callHistoryImagePath = null;
        if ($request->hasFile('call_history_img')) {
            $callHistoryImagePath = $request->file('call_history_img')->store('call_history_images', 'public');
        }

        // Create a new record in the database
        $yourModel = Vendor::create([
            'comments' => $request->input('comments'),
            'note' => $request->input('note'),
            'next_followup_date' => $request->input('next_followup_date'),
            'next_followup_time' => $request->input('next_followup_time'),
            'next_followup_am_pm' => $request->input('next_followup_am_pm'),
            'tags' => $request->input('tags'),
            'call_record' => $callRecordPath,
            'call_history_img' => $callHistoryImagePath,
            'client_type' => $request->input('client_type'),
            'task_status' => $request->input('task_status'),
        ]);

        // Redirect or return a response after successful form submission
        return redirect()->route('vendors.index')->with('success', 'Data has been saved successfully!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
