<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enquiries = Enquiry::orderByDesc('created_at')->get();
        return view('backend.enquiry_list', compact('enquiries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $categories = Category::orderByDesc('created_at')->get();
        return view('backend.enquiry_create', compact('subcategories', 'categories'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subcategory_id' => 'nullable|string|max:255',
            'move_from_origin' => 'nullable|string|max:255',
            'move_from_destination' => 'nullable|string|max:255',
            'date_time' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'mobile_number' => 'nullable|string|max:255',
            'otp' => 'nullable|string|max:255',
        ]);

        Enquiry::create($validatedData);
        // $enquiry = new Enquiry();

        return redirect(route('enquiry.index'))->with('success', 'Enquiry submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function fetchsubcategory($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)->get()->map(function ($subcategory) {
            $subcategory->name = ucwords($subcategory->name);
            return $subcategory;
        });
    
        if ($subcategories->isEmpty()) {
            return response()->json(['status' => 0, 'message' => 'No subcategory found']);
        }
        return response()->json(['status' => 1, 'data' => $subcategories]);
    }
    
}
