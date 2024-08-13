<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use App\Models\ServiceDetail;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ServiceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $categories = Category::orderByDesc('created_at')->get();
        $menusCat = Menu::orderByDesc('created_at')->get();
        $serviceDetails = ServiceDetail::with('subCategory')->orderByDesc('created_at')->get();
        return view('backend.service-detail.index', compact('serviceDetails','subcategories','categories','menusCat'));
    }

    /**
     * Store a newly created resource in storage.
     */public function store(Request $request)
{
    $request->validate([
        'description' => 'required',
        'summary' => 'required',
        // other validation rules
    ]);

    $serviceDetail = new ServiceDetail();
    $serviceDetail->subcategory_id = $request->subcategory_id;
    $serviceDetail->description = $request->description;
    $serviceDetail->summery = $request->summary;
    // other fields
    $serviceDetail->save();

    return redirect()->route('service-detail.index')->with('success', 'Service detail added successfully.');
}






    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $serviceDetail = ServiceDetail::findOrFail($id);
        $categories = Category::all();
        $subcategories = SubCategory::where('category_id', $serviceDetail->subcategory->category_id)->get();
    
        return response()->json([
            'status' => 1,
            'data' => [
                'serviceDetail' => $serviceDetail,
                'categories' => $categories,
                'subcategories' => $subcategories,
            ]
        ]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'summary' => 'required',
            // other validation rules
        ]);
    
        $serviceDetail = ServiceDetail::find($id);
        $serviceDetail->subcategory_id = $request->subcategory_id;
        $serviceDetail->description = $request->description;
        $serviceDetail->summery = $request->summary;
        // other fields
        $serviceDetail->save();
    
        return redirect()->route('service-detail.index')->with('success', 'Service detail updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */public function destroy($id)
{
    $service = ServiceDetail::findOrFail($id);
    if ($service) {
        $service->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
    return redirect()->back()->with('error', 'Something went wrong');
}

}
