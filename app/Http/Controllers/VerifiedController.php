<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verified;
use App\Services\FileUploadService;

class VerifiedController extends Controller
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
    public function index()
    {
        $verifieds = Verified::orderByDesc('created_at')->paginate(10);
        return view("backend.vendor.verified", compact("verifieds"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image', // Adding an image validation rule
        ]);

        $review = new Verified($request->all());
        $review->slug = generateSlug($request->name);
        $review->created_by = auth()->id();

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('verified/', $request->file('image'));
            $review->image = $filename;
        }

        $review->save();

        // Return a JSON response
        return response()->json(['success' => true, 'message' => 'Added Successfully']);
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
    public function edit(Verified $verified)
    {
        return response()->json([
            'verified' => [
                'id' => $verified->id,
                'name' => $verified->name,
                'image' => $verified->image,

            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048', // Make image optional
        ]);

        $review = Verified::findOrFail($id);

        $review->name = $request->name;
        $review->slug = generateSlug($request->name);
        $review->created_by = auth()->id();

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('verified/', $request->file('image'));
            $review->image = $filename;
        }

        $review->save();

        return response()->json(['success' => true, 'message' => 'Updated successfully.']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(Verified $verified)
    {
        $verified->delete();

        return redirect()->back()->with(['message' => 'Deleted Successfully', 'alert-type' => 'success']);
    }

    public function verifyStatus(Request $request)
    {
        $item = Verified::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();
            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }
}
