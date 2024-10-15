<?php

namespace App\Http\Controllers;
use App\Models\Package;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubMenu;
use App\Models\Menu;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Package::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        $packages = $query->paginate(10);

        if ($request->ajax()) {
            return view('backend.package.partials.package-index', compact('packages'))->render();
        }
        return view('backend.package.index', compact('packages'));
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
        $packages = Package::get();
        $products = Product::get();
        return view('backend.package.create', compact('packages','categories','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'menu_id' => 'required',
            'submenu_id' => 'required',
            'quantity' => 'required',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Create a new Package instance
        $product = new Package();
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->menu_id = $request->menu_id;
        $product->submenu_id = $request->submenu_id;
        $product->quantity = $request->quantity;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        // Save the package
        $product->save();

        // Redirect with a success message
        return redirect()->route('package.index')->with(['message' => 'Added Successfully', 'alert-type' => 'success']);
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
        // $countryId = Country::where('name', 'India')->value('id');
        // $states = State::where('country_id', $countryId)->get(['name', 'id']);
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();

        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        $package = Package::findOrFail($id);
        $menus = Menu::orderByDesc('created_at')->get();
        return view('backend.package.edit', compact( 'subcategories', 'submenus','categories','package','menus'));
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
        $validated = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'menu_id' => 'required',
            'submenu_id' => 'required',
            'quantity' => 'required',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $product = Package::find($id);
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->menu_id = $request->menu_id;
        $product->submenu_id = $request->submenu_id;
        $product->quantity = $request->quantity;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        // return $product;
        $product->save();

        return redirect()->route('package.index')->with(['message' => 'Updated Successfully', 'alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::find($id);

        if ($package) {
            $package->delete();
            return redirect()->back()->with(['message' => 'Deleted Successfully', 'alert-type' => 'success']);
        } else {
            return redirect()->back()->with('error', 'Package not found');
        }

    }

    public function fetchProductData(Request $request)
    {

         $product = Product::where('submenu_id', $request->submenu_id)->first();

        if ($product) {
            return response()->json([
                'success' => true,
                'product' => $product
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No product found'
            ]);
        }
    }
}
