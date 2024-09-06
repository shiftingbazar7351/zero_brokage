<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\State;

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
        return view('backend.products.index',compact('products'));
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
        return view('backend.products.create',compact('categories','states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'category_id' => 'required|array',
            'subcategory_id' => 'required|array',
            'menu_id' => 'required|array',
            'submenu_id' => 'required|array',
            'state' => 'required|array',
            'city' => 'required|array',
            'gst' => 'required|array',
            'hsn' => 'required|array',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);
    
        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'created_by' => auth()->id(),
        ]);
    
        // Sync the relationships
        $product->categories()->sync($request->category_id);
        $product->subcategories()->sync($request->subcategory_id);
        $product->menus()->sync($request->menu_id);
        $product->submenus()->sync($request->submenu_id);
        $product->states()->sync($request->state);
        $product->cities()->sync($request->city);
    
        return redirect(route('products.index'))->with('success', 'Product added successfully');
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
