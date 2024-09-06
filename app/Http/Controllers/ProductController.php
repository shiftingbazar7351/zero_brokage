<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubMenu;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countryId = Country::where('name', 'India')->value('id');
        $states = State::where('country_id', $countryId)->get(['name', 'id']);
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        return view('backend.products.create', compact('categories', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function store(Request $request)
    {
        // Validate the form input
        $validated = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'menu_id' => 'required',
            'submenu_id' => 'required',
            'state' => 'required',
            'city' => 'required',
            'gst' => 'required',
            'hsn' => 'required',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);
        // return $request->all();
        $product = Product::create([
            'category_id' => json_encode($request->category_id), // Use json_encode if storing multiple IDs
            'subcategory_id' => json_encode($request->subcategory_id),
            'menu_id' => json_encode($request->menu_id),
            'submenu_id' => json_encode($request->submenu_id),
            'state' => json_encode($request->state),
            'city' => json_encode($request->city),
            'gst' => json_encode($request->gst),
            'hsn' => json_encode($request->hsn),
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        // Redirect back with a success message
        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::findOrFail($id);
        return view("backend.products.show",compact('products',));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countryId = Country::where('name', 'India')->value('id');
        $states = State::where('country_id', $countryId)->get(['name', 'id']);
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();

        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        $product = Product::findOrFail($id);
        return view('backend.products.edit', compact('product', 'subcategories', 'submenus','categories','states'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the form input
        $validated = $request->validate([
            // 'category_id' => 'required', // Uncomment if these fields need to be updated
            // 'subcategory_id' => 'required',
            // 'menu_id' => 'required',
            // 'submenu_id' => 'required',
            // 'state' => 'required',
            // 'city' => 'required',
            // 'gst' => 'required',
            // 'hsn' => 'required',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);
    
        // Find the existing product by ID
        $product = Product::find($id);
    
        // Update the product with the validated data
        $product->update([
            'category_id' => json_encode($request->category_id), // Use json_encode if storing multiple IDs
            'subcategory_id' => json_encode($request->subcategory_id),
            'menu_id' => json_encode($request->menu_id),
            'submenu_id' => json_encode($request->submenu_id),
            'state' => json_encode($request->state),
            'city' => json_encode($request->city),
            'gst' => json_encode($request->gst),
            'hsn' => json_encode($request->hsn),
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);
    
        // Redirect back with a success message
        // return redirect()->back()->with('success', 'Updated Successfully');
        return redirect()->route('products.index')->with('success', 'Updated  Successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Product::find($id);

        if ($service) {
            $service->delete();
            return redirect()->back()->with('success', 'Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Product not found');
        }
    }
}