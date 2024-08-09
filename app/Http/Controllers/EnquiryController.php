<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Enquiry;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('backend.enquiry_list', compact('enquiries', 'subcategories', 'categories'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string',
            'subcategory_id' => 'required|string',
            'move_from_origin' => 'required|string|max:255',
            // 'check_me_out' => 'required|string|max:255',
            'date_time' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_number' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $enquiry = new Enquiry($request->all());
        $enquiry->save();
        session()->flash('success', 'Submitted Successfully');
        return response()->json(['redirect' => url()->previous()]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        return view('backend.enquiry_list', compact('enquiry'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string',
            'subcategory_id' => 'required|string',
            'move_from_origin' => 'required|string|max:255',
            'date_time' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_number' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $enquiry = new Enquiry($request->all());
        $enquiry->update();
        session()->flash('success', 'Updated Successfully');
        return response()->json(['redirect' => url()->previous()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $enquiry = Enquiry::find($id);
        if ($enquiry) {
            $enquiry->delete();
            return redirect(route('enquiry.index'))->with('success', 'Enquiry deleted successfully!');
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
