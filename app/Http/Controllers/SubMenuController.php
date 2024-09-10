<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Menu;
use App\Models\State;
use App\Models\SubCategory;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Storage;
use Exception;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    public function index()
    {
        $menus = Menu::where('status', 1)->orderBydesc('created_at')->get();
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $subcategories = Subcategory::where('status', 1)->orderByDesc('created_at')->get();
        $countryId = Country::where('name', 'India')->value('id');
        $states = State::where('country_id', $countryId)->get(['name', 'id']);
        $submenus = SubMenu::orderByDesc('created_at')->paginate(01);
        return view('backend.sub-menu.index', compact('submenus', 'categories', 'states', 'menus', 'subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sub_menus,name',
            'category' => 'required',
            'subcategory_id' => 'required',
            'menu' => 'required',
            'state' => 'required',
            'city' => 'required',
            'total_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'details' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $finalPrice = $request->input('total_price');
        $discountPercentage = $request->input('discount');

        if (!empty($finalPrice) && !empty($discountPercentage)) {
            $discountAmount = ($finalPrice * $discountPercentage) / 100;
            $finalPrice -= $discountAmount;
        } else {
            $finalPrice = $request->input('total_price');
        }

        $subcategory = new SubMenu();
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category;
        $subcategory->subcategory_id = $request->subcategory_id;
        $subcategory->menu_id = $request->menu;
        $subcategory->city_id = $request->city;
        $subcategory->description = $request->description;
        $subcategory->details = $request->details;
        $subcategory->slug = generateSlug($request->name);
        $subcategory->total_price = $request->total_price;
        $subcategory->discount = $request->discount;
        $subcategory->discounted_price = $finalPrice;

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('submenu/', $request->file('image'));
            $subcategory->image = $filename;
        }

        $subcategory->save();
        return response()->json(['success' => true, 'message' => 'Sub-Menu added successfully!']);
        // return redirect()->back()->with('success', 'Sub-menu created successfully.');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $submenu = SubMenu::find($id);
        // return response()->json([
        //     'status' => 1,
        //     'data' => $submenu,
        // ]);
        return response()->json(['data' => $submenu]);

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubMenu $sub_menu)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required',
            // 'category_id' => 'required|exists:categories,id',
            // 'subcategory_id' => 'required|exists:subcategories,id',
            // 'menu_id' => 'required|exists:menus,id',
            // 'state' => 'required|exists:states,id',
            // 'city_id' => 'required|exists:cities,id',
            'total_price' => 'required|numeric',
            'discount' => 'required|numeric',
            // 'final_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional
        ]);

        $finalPrice = $request->input('price');
        $discountPercentage = $request->input('discount');
        if (!empty($finalPrice) && !empty($discountPercentage)) {
            $discountAmount = ($finalPrice * $discountPercentage) / 100;
            $finalPrice -= $discountAmount;
        } else {
            $finalPrice = $request->input('price');
        }


        $sub_menu->name = $request->input('name');
        $sub_menu->slug = generateSlug($request->name);
        $sub_menu->category_id = $request->input('category_id');
        $sub_menu->subcategory_id = $request->input('subcategory_id');
        $sub_menu->menu_id = $request->input('menu_id');
        // $sub_menu->state = $request->input('state');
        $sub_menu->city_id = $request->input('city_id');
        $sub_menu->total_price = $request->input('total_price');
        $sub_menu->discount = $request->input('discount');
        $sub_menu->discounted_price = $finalPrice;
        $sub_menu->description = $request->input('description');

        // Handle image upload
        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('submenu/', $request->file('image'));
            $sub_menu->image = $filename;
        }

        $sub_menu->save();

        return response()->json(['success' => true, 'message' => 'Sub-Menu updated successfully!']);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        try {
            $submenu = SubMenu::findOrFail($id);

            $img = $submenu->image;
            $submenu->forceDelete();
            if ($img) {
                $this->fileUploadService->removeImage('submenu/', $img);
            }

            $submenu->delete();
            return redirect()->back()->with('success', 'Menu Deleted.');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    public function fetchsubcategory(Request $request)
    {
        $categoryIds = $request->category_ids; // Receive array of category IDs
        $data = SubCategory::whereIn('category_id', $categoryIds)->get(); // Fetch subcategories for multiple categories
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
    public function subMenuStatus(Request $request)
    {
        $item = SubMenu::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }


    public function getMenus(Request $request, $subcategoryId)
    {
        $menus = Menu::where('subcategory_id', $subcategoryId)->get();
        return response()->json([
            'status' => 1,
            'data' => $menus
        ]);
    }

}
