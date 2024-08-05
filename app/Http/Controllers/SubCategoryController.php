<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::all();
        $categories = Category::all();
        $countryId = Country::where('name', 'India')->value('id');
        $states = State::where('country_id', $countryId)->get(['name', 'id']);

        return view('backend.sub-category.index', compact('subcategories', 'categories', 'states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
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
        $subcategory->category_id = $request->input('category_id');
        // $subcategory->state_id = $request->input('state_id');
        $subcategory->city_id = $request->input('city_id');
        $subcategory->price = $request->input('price');
        $subcategory->discount = $request->input('discount');
        $subcategory->final_price = $finalPrice;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('assets/subcategory', $imageName, 'public');
            $subcategory->image = $imageName;
        }

        $subcategory->save();

        return redirect()->back()->with('success', 'Sub-Category created successfully.');
    }

    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        return response()->json($subcategory);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
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

        $subcategory = SubCategory::findOrFail($id);
        $subcategory->name = $request->input('name');
        $subcategory->category_id = $request->input('category_id');
        // $subcategory->state_id = $request->input('state_id');
        $subcategory->city_id = $request->input('city_id');
        $subcategory->price = $request->input('price');
        $subcategory->discount = $request->input('discount');
        $subcategory->final_price = $finalPrice;

        if ($request->hasFile('image')) {
            if ($subcategory->image) {
                Storage::disk('public')->delete('assets/subcategory/' . $subcategory->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('assets/subcategory', $imageName, 'public');
            $subcategory->image = $imageName;
        }

        $subcategory->save();

        return redirect()->back()->with('success', 'SubCategory updated successfully.');
    }

    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();
        return redirect()->back()->with('success', 'SubCategory deleted successfully.');
    }

    public function fetchCity($stateId)
    {
        $cities = City::where('state_id', $stateId)->get()->map(function ($city) {
            $city->name = ucwords($city->name);
            return $city;
        });

        if ($cities->isEmpty()) {
            return response()->json(['status' => 0, 'message' => 'No cities found']);
        }

        return response()->json(['status' => 1, 'data' => $cities]);
    }

    public function updateStatus(Request $request)
    {
        $item = SubCategory::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }
}
