<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\State;
use App\Models\City;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
    $subcategories = SubCategory::all();
    $categories = Category::all();

    $countryId = Country::where('name', 'India')->value('id');

    $states = State::where('country_id', $countryId)->get(['name','id']);

    return view('backend.sub-category.index', compact('subcategories', 'categories', 'states'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state' => 'nullable|exists:states,id',
            'city' => 'nullable|exists:cities,id',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'final_price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $finalPrice = $request->input('price');
        $discountPercentage = $request->input('discount');

        if (!empty($finalPrice) && !empty($discountPercentage)) {
            $discountAmount = ($finalPrice * $discountPercentage) / 100;
            $finalPrice -= $discountAmount;
        } else {
            $finalPrice = $request->input('price');
        }
    
        $subcategory = new SubCategory();
        $subcategory->name = $request->input('name');
        $subcategory->category_id = $request->input('category');
        // $subcategory->state_id = $request->input('state');
        $subcategory->city_id = $request->input('city');
        $subcategory->price = $request->input('price');
        $subcategory->discount = $request->input('discount');
        $subcategory->final_price = $finalPrice;



        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique name
            $image->storeAs('assets/subcategory', $imageName, 'public'); // Store the image in assets/category
            $subcategory->image = $imageName; // Save the unique name
        }
    

        $subcategory->save();

        return redirect()->back()->with('success', 'Sub-Category created successfully.');
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
        $subcategories = SubCategory::findOrFail($id);
        $category =  Category::get();
        return view('backend.sub-category.edit', compact('subcategories','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'nullable|string|max:255', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $subcategory = SubCategory::findOrFail($id);
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); 
            $image->storeAs('assets/subcategory', $imageName, 'public'); 
            $subcategory->image = $imageName; 
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($subcategory->image) {
                \Storage::disk('public')->delete('assets/subcategory/' . $subcategory->image);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique name
            $image->storeAs('assets/subcategory', $imageName, 'public'); // Store the image in assets/category
            $subcategory->image = $imageName; // Save the unique name
        }

        $subcategory->save();

        return redirect()->back()->with('success', 'SubCategory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();
        return redirect()->back()->with('success', 'SubCategory deleted successfully.');
    }
    public function fetchsubcategory($category_id = null) {
        $data = SubCategory::where('category_id', $category_id)->get();
        return response()->json([
            'status' => 1,
            'data' => $data
        ]);
    }

    public function fetchmenu($menu_id = null) {
        $data = Menu::where('subcategory_id', $menu_id)->get();
        return response()->json([
            'status' => 1,
            'data' => $data
        ]);
    }


    public function fetchcity($state_id = null) {
        $data = City::where('state_id', $state_id)->get();
        return response()->json([
            'status' => 1,
            'data' => $data
        ]);
    }

    
}
