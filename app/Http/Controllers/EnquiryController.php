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
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $categories = Category::orderByDesc('created_at')->get();
        $enquiries = Enquiry::orderByDesc('created_at')->get();
        return view('backend.enquiry_list', compact('enquiries','subcategories', 'categories'));
    }


    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'subcategory_id' => 'nullable|string|max:255',
            'move_from_origin' => 'nullable|string|max:255',
            'move_from_destination' => 'nullable|string|max:255',
            'date_time' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'mobile_number' => 'nullable|string|max:255',
        ]);
    
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['status' => 0, 'errors' => $validator->errors()]);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $enquiry = Enquiry::create($validator->validated());
    
        if ($request->ajax()) {
            return response()->json(['status' => 1, 'message' => 'Enquiry submitted successfully!', 'data' => $enquiry]);
        }
    
        return redirect(route('enquiry.index'))->with('success', 'Enquiry submitted successfully!');
    }
    
    



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $enquiry = Enquiry::find($id);
    
        if ($enquiry) {
            $enquiry->delete();
    
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'message' => 'Enquiry deleted successfully!']);
            }
    
            return redirect(route('enquiry.index'))->with('success', 'Enquiry deleted successfully!');
        }
    
        if ($request->ajax()) {
            return response()->json(['status' => 0, 'message' => 'Enquiry not found!']);
        }
    
        return redirect(route('enquiry.index'))->with('error', 'Enquiry not found!');
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
