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
<<<<<<< HEAD
        return view('backend.package.create', compact('packages','categories'));
=======
        $products = Product::get();
        return view('backend.package.create', compact('packages','categories','products'));
>>>>>>> 0c852a3875ed29744674d07e140907a1bd8825fa
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        // Validate the form input
=======
>>>>>>> 0c852a3875ed29744674d07e140907a1bd8825fa
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

<<<<<<< HEAD
        $product = Product::create([

            'category_id' => json_encode($request->category_id), // Use json_encode if storing multiple IDs
            'subcategory_id' => json_encode($request->subcategory_id),
            'menu_id' => json_encode($request->menu_id),
            'submenu_id' => json_encode($request->submenu_id),

            'quantity' => $request->quantity,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')->with(['message' => 'Added Successfully', 'alert-type' => 'success']);
    }

=======
        // Create a new Package instance
        $product = new Package();
        $product->category_id = json_encode($request->category_id); // Store as JSON
        $product->subcategory_id = json_encode($request->subcategory_id); // Store as JSON
        $product->menu_id = json_encode($request->menu_id); // Store as JSON
        $product->submenu_id = json_encode($request->submenu_id); // Store as JSON
        $product->quantity = $request->quantity;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        // Save the package
        $product->save();

        // Redirect with a success message
        return redirect()->route('package.index')->with(['message' => 'Added Successfully', 'alert-type' => 'success']);
    }


>>>>>>> 0c852a3875ed29744674d07e140907a1bd8825fa
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
<<<<<<< HEAD
        $countryId = Country::where('name', 'India')->value('id');
        $states = State::where('country_id', $countryId)->get(['name', 'id']);
=======
        // $countryId = Country::where('name', 'India')->value('id');
        // $states = State::where('country_id', $countryId)->get(['name', 'id']);
>>>>>>> 0c852a3875ed29744674d07e140907a1bd8825fa
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();

        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
<<<<<<< HEAD
        $product = Product::findOrFail($id);
        return view('backend.products.edit', compact('product', 'subcategories', 'submenus','categories','states'));
=======
        $package = Package::findOrFail($id);
        $menus = Menu::orderByDesc('created_at')->get();
        return view('backend.package.edit', compact( 'subcategories', 'submenus','categories','package','menus'));
>>>>>>> 0c852a3875ed29744674d07e140907a1bd8825fa
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
<<<<<<< HEAD
        //
=======
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

        $product->save();

        return redirect()->route('package.index')->with(['message' => 'Updated Successfully', 'alert-type' => 'success']);
>>>>>>> 0c852a3875ed29744674d07e140907a1bd8825fa
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
<<<<<<< HEAD
=======

    // public function fetchProductData(Request $request)
    // {

    //     $product = Product::where('submenu_id', $request->submenu_id)->first();

    //     if ($product) {
    //         return response()->json([
    //             'success' => true,
    //             'product' => $product
    //         ]);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'No product found'
    //         ]);
    //     }
    // }

    public function fetchProductData(Request $request)
    {
        // Check if multiple submenu_ids are provided
        $submenuIds = $request->submenu_id;

        if (is_array($submenuIds) && count($submenuIds) > 1) {
            // Fetch products if more than one submenu_id
            $products = Product::whereIn('submenu_id', $submenuIds)->get();

            if ($products->count() > 0) {
                // Calculate average price manually
                $totalPrice = 0;
                $productCount = $products->count();

                foreach ($products as $product) {
                    $totalPrice += $product->price; // Sum the prices
                }

                $averagePrice = $totalPrice / $productCount; // Calculate average price

                return response()->json([
                    'success' => true,
                    'average_price' => $averagePrice,
                    'is_multiple' => true
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No products found'
                ]);
            }
        } else {
            // Fetch single product if only one submenu_id is provided
            $product = Product::where('submenu_id', $submenuIds)->first();

            if ($product) {
                return response()->json([
                    'success' => true,
                    'product' => $product,
                    'is_multiple' => false
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No product found'
                ]);
            }
        }
    }



>>>>>>> 0c852a3875ed29744674d07e140907a1bd8825fa
}
