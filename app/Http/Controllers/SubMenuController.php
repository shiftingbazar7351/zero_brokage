<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
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
     */

    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    public function index(Request $request)
    {
        $query = submenu::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
            ->orderByDesc('created_at');
        }
        // Paginate the users (adjust pagination number as needed)
        $submenus = $query->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('backend.sub-menu.partials.submenu-index', compact('submenus'))->render();
        }
        $menus = Menu::where('status', 1)->orderBydesc('created_at')->get();
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $subcategories = Subcategory::where('status', 1)->orderByDesc('created_at')->get();
        $countryId = Country::where('name', 'India')->value('id');
        $states = State::where('country_id', $countryId)->get(['name', 'id']);
        return view('backend.sub-menu.index', compact('submenus', 'categories', 'states', 'menus', 'subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sub_menus|max:255',
            'category' => 'required',
            'subcategory_id' => 'required',
            'menu' => 'required',
            'state' => 'required',
            'city' => 'required',
            // 'total_price' => 'required|numeric',
            // 'discount' => 'required|numeric',
            'details' => 'required',
            'description' => 'required',
            'image' => 'required|image|max:2048',
        ]);


        // $finalPrice = $request->input('total_price');
        // $discountPercentage = $request->input('discount');

        // if (!empty($finalPrice) && !empty($discountPercentage)) {
        //     $discountAmount = ($finalPrice * $discountPercentage) / 100;
        //     $finalPrice -= $discountAmount;
        // } else {
        //     $finalPrice = $request->input('total_price');
        // }

        $sub_menu = new SubMenu();
        $sub_menu->name = $request->name;
        $sub_menu->category_id = $request->category;
        $sub_menu->subcategory_id = $request->subcategory_id;
        $sub_menu->menu_id = $request->menu;
        $sub_menu->city_id = $request->city;
        $sub_menu->description = $request->description;
        $sub_menu->details = $request->details;
        $sub_menu->slug = generateSlug($request->name);
        // $sub_menu->total_price = $request->total_price;
        // $sub_menu->discount = $request->discount;
        // $sub_menu->discounted_price = $finalPrice;

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('submenu/', $request->file('image'));
            $sub_menu->image = $filename;
        }

        $sub_menu->save();
        return response()->json(['success' => true, 'message' => 'Sub-Menu added successfully!']);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        // dd($states);
        $submenu = SubMenu::find($id);
        $city = City::where('id',$submenu->city_id)->first();
        $state = State::where('id',$city->state_id)->first();
        return response()->json(['data' => $submenu, 'state' => $state] );

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        // Find the existing SubMenu by ID
        $sub_menu = SubMenu::findOrFail($id); // This will throw a 404 if the submenu is not found

        // Validate the input data
        $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('sub_menus')->ignore($sub_menu->id)
            ],
            // 'total_price' => 'required|numeric',
            // 'discount' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        // Calculate final price with discount

        // $finalPrice = $request->input('total_price');
        // $discountPercentage = $request->input('discount');

        // if (!empty($finalPrice) && !empty($discountPercentage)) {
        //     $discountAmount = ($finalPrice * $discountPercentage) / 100;
        //     $finalPrice -= $discountAmount;
        // } else {
        //     $finalPrice = $request->input('total_price');
        // }

        // Update submenu fields  details
        $sub_menu->name = $request->input('name');
        $sub_menu->slug = generateSlug($request->name);
        $sub_menu->category_id = $request->input('category_id');
        $sub_menu->subcategory_id = $request->input('subcategory_id');
        $sub_menu->menu_id = $request->input('menu_id');
        $sub_menu->city_id = $request->input('city');
        // $sub_menu->total_price = $request->input('total_price');
        // $sub_menu->discount = $request->input('discount');
        // $sub_menu->discounted_price = $finalPrice;
        $sub_menu->details = $request->details;
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
            return redirect()->back()->with(['message' => 'Deleted Successfully', 'alert-type' => 'success']);

        } catch (Exception $e) {
            return redirect()->back()->with(['message' => 'Something went wrong', 'alert-type' => 'error']);
        }
    }
    public function fetchsubcategory($id = null)
    {
        $data = SubCategory::where('category_id', $id)->get();
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


    public function getMenus($subcatId = null)
    {
        $menus = Menu::where('subcategory_id', $subcatId)->get();
        return response()->json([
            'status' => 1,
            'data' => $menus
        ]);
    }

}
