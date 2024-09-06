<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Enquiry;
use App\Models\Menu;
use App\Models\SubMenu;
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
        $menus = Menu::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        $enquiries = Enquiry::with('subcategory.categoryName')->orderByDesc('created_at')->get();
        return view('backend.enquiry.index', compact('enquiries', 'subcategories', 'categories','menus','submenus'));
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
        $enquiry = Enquiry::create($request->all());
        $enquiry->created_by = auth()->user()->id;
        $enquiry->save();
        session()->flash('success', 'Submitted Successfully');
        return response()->json(['redirect' => url()->previous()]);
    }

    public function show($id)
    {
        $enquirys = Enquiry::with('categoryName','subcategory')->findOrFail($id);
        return view("backend.enquiry.show",compact('enquirys',));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enquiry $enquiry)
    {
        return response()->json(['enquiry' => $enquiry]);

    }




    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $id)
     {
         $validator = Validator::make($request->all(), [
            //  'category' => 'required|string',
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

         $enquiry = Enquiry::find($id);
         if (!$enquiry) {
             return response()->json(['error' => 'Enquiry not found'], 404);
         }

         $enquiry->update($request->all());

        //  session()->flash('success', 'Updated Successfully');
         return redirect()->back()->with('success','Updated Successfully');
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

    public function fetchMenu($subcategoryId)
    {
        $menus = Menu::where('subcategory_id', $subcategoryId)->get()->map(function ($menu) {
            $menu->name = ucwords($menu->name);
            return $menu;
        });

        if ($menus->isEmpty()) {
            return response()->json(['status' => 0, 'message' => 'No menu found']);
        }

        return response()->json(['status' => 1, 'data' => $menus]);
    }


    public function enquiryStatus(Request $request)
    {
        $item = Enquiry::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }
    // public function reportData()
    // {
    //     return view('backend.report');
    // }

}
