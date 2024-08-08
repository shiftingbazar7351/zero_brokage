<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Menu;
use App\Models\State;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        // $subcategory = SubCategory::orderByDesc('created_at')->first();
        $categories = Category::orderByDesc('created_at')->get();
        $countryId = Country::where('name', 'India')->value('id');
        $states = State::where('country_id', $countryId)->get(['name', 'id']);
        $cities = City::get();
        return view('backend.sub-category.index', compact('subcategories', 'categories', 'states','cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories,name',
            'state' => 'nullable|exists:states,id',
            'city' => 'nullable|exists:cities,id',
            'total_price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'discounted_price' => 'nullable|numeric',
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
        $subcategory->slug = $this->generateSlug($request->name);
        $subcategory->city_id = $request->input('city');
        $subcategory->total_price = $request->input('price');
        $subcategory->discount = $request->input('discount');
        $subcategory->discounted_price = $finalPrice;


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('assets/subcategory', $imageName, 'public');
            $subcategory->image = $imageName;
        }

        $subcategory->save();

        return redirect()->back()->with('success', 'Sub-Category created successfully.');
    }

    protected function generateSlug($name)
    {
        $slug = str_replace(' ', '_', $name);
        $slug = strtolower($slug);
        return $slug;
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
    public function edit($id)
    {
        $record = SubCategory::find($id);
        $states = State::all();
        $selectedCity = $record->city_id;
        $selectedState = City::where('id', $selectedCity)->pluck('state_id')->first();
        $cities = City::where('state_id', $selectedState)->get()->map(function ($city) {
            $city->name = ucwords($city->name);
            return $city;
        });

        return view('backend.sub-category.index', compact('record', 'states', 'selectedState', 'selectedCity', 'cities'));
    }



    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories,name,' . $request->id,
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'final_price' => 'nullable|numeric',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow multiple images
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
        $subcategory->category_id = $request->input('category');
        $subcategory->city_id = $request->input('city_id');
        $subcategory->total_price = $request->input('price');
        $subcategory->discount = $request->input('discount');
        $subcategory->discounted_price = $finalPrice;

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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();
        return redirect()->back()->with('success', 'SubCategory deleted successfully.');
    }
    public function fetchsubcategory($category_id = null)
    {
        $data = SubCategory::where('category_id', $category_id)->get();
        return response()->json([
            'status' => 1,
            'data' => $data,
        ]);
    }

    public function fetchmenu($menu_id = null)
    {
        $data = Menu::where('subcategory_id', $menu_id)->get();
        return response()->json([
            'status' => 1,
            'data' => $data,
        ]);
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
    // public function editFetchCity($cityId)
    // {
    //     $cities = City::where('id',$cityId)->first();
    //     // $cities = City::where('state_id', $stateId)->get()->map(function ($city) {
    //     //     $city->name = ucwords($city->name);
    //     //     return $city;
    //     // });
    //     if ($cities->isEmpty()) {
    //         return response()->json(['status' => 0, 'message' => 'No cities found']);
    //     }
    //     return response()->json(['status' => 1, 'data' => $cities]);
    // }
}