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
        $submenus = SubMenu::orderByDesc('created_at')->get();
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
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'total_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'discounted_price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $finalPrice = $request->input('price');
        $discountPercentage = $request->input('discount');

        if (!empty($finalPrice) && !empty($discountPercentage)) {
            $discountAmount = ($finalPrice * $discountPercentage) / 100;
            $finalPrice -= $discountAmount;
        } else {
            $finalPrice = $request->input('price');
        }

        $subcategory = new SubMenu();
        $subcategory->subcategory_id = $request->subcategory_id;
        $subcategory->menu_id = $request->menu;
        $subcategory->category_id = $request->category_id;
        $subcategory->city_id = $request->input('city');
        $subcategory->name = $request->input('name');
        $subcategory->category_id = $request->input('category');
        $subcategory->slug = generateSlug($request->name);
        $subcategory->total_price = $request->input('price');
        $subcategory->discount = $request->input('discount');
        $subcategory->discounted_price = $finalPrice;

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('submenu/', $request->file('image'));
            $subcategory['image'] = $filename;
        }

        $subcategory->save();
        return redirect()->back()->with('success', 'Sub-menu created successfully.');
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
        $submenu = SubMenu::find($id);
    
        // Check if submenu exists
        if (!$submenu) {
            return response()->json(['error' => 'SubMenu not found'], 404);
        }
        return response()->json([
            // 'submenu' => [
                'subcategory_id'=>$submenu->subcategory_id,
                'menu_id'=>$submenu->menu,
                'id' => $submenu->id,
                'name' => $submenu->name,
                'category_id' => $submenu->category_id,
                'menu_id' => $submenu->menu_id,
                'state_id' => $submenu->state_id,
                'city_id' => $submenu->city_id,
                'price' => $submenu->total_price,
                'discount' => $submenu->discount,
                'final_price' => $submenu->edit_final_price,
                'image_url' => $submenu->image ? Storage::url('assets/submenu/' . $submenu->image) : asset('admin/assets/img/icons/upload.svg'),
            // ]
        ]);
    
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
        $request->validate([
            'name' => 'required|unique:sub_menus,name,' . $request->id,
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'final_price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow multiple images
        ]);

        $finalPrice = $request->input('price');
        $discountPercentage = $request->input('discount');

        if (!empty($finalPrice) && !empty($discountPercentage)) {
            $discountAmount = ($finalPrice * $discountPercentage) / 100;
            $finalPrice -= $discountAmount;
        } else {
            $finalPrice = $request->input('price');
        }

        $subcategory = SubMenu::findOrFail($id);
        $subcategory->subcategory_id = $request->subcategory;
        $subcategory->category_id = $request->category_id;
        $subcategory->menu_id = $request->menu_id;
        $subcategory->name = $request->input('name');
        $subcategory->category_id = $request->input('category');
        $subcategory->city_id = $request->input('city_id');
        $subcategory->total_price = $request->input('price');
        $subcategory->discount = $request->input('discount');
        $subcategory->discounted_price = $finalPrice;

        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('submenu/', $request->file('image'));
            $subcategory['image'] = $filename;
        }
        $subcategory->save();
        return redirect()->back()->with('success', 'Sub-menu updated successfully.');
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


    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    public function getMenus($subcategoryId)
    {
        $menus = Menu::where('subcategory_id', $subcategoryId)->get();
        return response()->json($menus);
    }
}
