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
        $serviceDetails = ServiceDetail::with('subCategory')->orderByDesc('created_by')->get();
        return view('backend.service-detail.index', compact('serviceDetails','subcategories','categories','menusCat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $categories = Category::orderByDesc('created_at')->get();
        return view('backend.service-detail.create', compact('subcategories', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subcategory_id' => 'required|string',
            'description' => 'required|string',
            'summery' => 'nullable',
        ]);
        ServiceDetail::create($validatedData);
        return redirect(route('service-detail.index'))->with('success', 'Enquiry submitted successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $serviceDetail = ServiceDetail::findOrFail($id);
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $categories = Category::orderByDesc('created_at')->get();
        return view('backend.service-detail.edit', compact('serviceDetail', 'subcategories', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'subcategory_id' => 'required|string',
            'description' => 'required|string',
            'summery' => 'nullable',
        ]);

        $serviceDetail = ServiceDetail::findOrFail($id);
        $serviceDetail->update($validatedData);

        return redirect(route('service-detail.index'))->with('success', 'Service detail updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = ServiceDetail::findOrFail($id);
        if ($service) {
            $service->delete();
            return redirect()->back()->with('success', 'Deleted Successfully');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }
}
