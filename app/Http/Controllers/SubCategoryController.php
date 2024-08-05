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
    
        $subcategory = new SubCategory();
        $subcategory->name = $request->input('name');
        $subcategory->category_id = $request->input('category');
        $subcategory->slug = $this->generateSlug($request->name);
        $subcategory->city_id = $request->input('city');
        $subcategory->price = $request->input('price');
        $subcategory->discount = $request->input('discount');
        $subcategory->final_price = $finalPrice;
    
        if ($request->hasFile('images')) {
            $imageNames = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('assets/subcategory', $imageName, 'public');
                $imageNames[] = $imageName;
            }
            $subcategory->image = json_encode($imageNames); // Store image names as a JSON array
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
        $subcategory = SubCategory::findOrFail($id);
        return response()->json($subcategory);
    }

    
    /**
     * Update the specified resource in storage.
     */
 
     public function update(Request $request, $id)
     {
         $request->validate([
             'name' => 'required|string|max:255',
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
         $subcategory->category_id = $request->input('category_id');
         $subcategory->city_id = $request->input('city_id');
         $subcategory->price = $request->input('price');
         $subcategory->discount = $request->input('discount');
         $subcategory->final_price = $finalPrice;
     
         if ($request->hasFile('images')) {
             if ($subcategory->images) {
                 $oldImages = json_decode($subcategory->images, true);
                 foreach ($oldImages as $oldImage) {
                     Storage::disk('public')->delete('assets/subcategory/' . $oldImage);
                 }
             }
     
             $imageNames = [];
             foreach ($request->file('images') as $image) {
                 $imageName = time() . '_' . $image->getClientOriginalName();
                 $image->storeAs('assets/subcategory', $imageName, 'public');
                 $imageNames[] = $imageName;
             }
             $subcategory->images = json_encode($imageNames);
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
