<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $categories = Category::orderByDesc('created_at')->get();
        $menusCat = Menu::orderByDesc('created_at')->get();
        return view('backend.menu.index',compact('subcategories','categories','menusCat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required',
            'subcategory' => 'nullable',
            'icon' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        $menu = new Menu();
        $menu->name = $request->input('name');
        $menu->subcategory_id = $request->input('subcategory_id');
        $menu->slug = $this->generateSlug($request->name);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('assets/menu', $imageName, 'public');
            $menu->image = $imageName;
        }

        $menu->save();

        return response()->json(['status' => 1, 'message' => 'Menu added successfully!']);
    }
    protected function generateSlug($name)
    {
        $slug = str_replace(' ', '_', $name);
        $slug = strtolower($slug);
        return $slug;
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $categories = Category::all();
        $subcategories = SubCategory::where('category_id', $menu->category_id)->get();
        return view('backend.menu.index', compact('menu', 'categories', 'subcategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required',
            'subcategory_id' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->name = $request->input('name');
        $menu->subcategory_id = $request->input('subcategory_id');
        $menu->slug = $this->generateSlug($request->input('name'));

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete('assets/menu/' . $menu->image);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('assets/menu', $imageName, 'public');
            $menu->image = $imageName;
        }

        $menu->save();

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }



    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->image) {
            Storage::disk('public')->delete('assets/menu/' . $menu->image);
        }

        $menu->delete();

        // return response()->json(['status' => 1, 'message' => 'Menu deleted successfully!']);
        return redirect()->back()->with('success', 'Menu Deleted.');
    }


    public function fetchsubcategory($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)->get()->map(function ($subcategory) {
            $subcategory->name = ucwords($subcategory->name);
            return $subcategory;
        });

        if ($subcategories->isEmpty()) {
            return response()->json(['status' => 0, 'message' => 'No subcategory found']);
        }
        return response()->json(['status' => 1, 'data' => $subcategories]);
    }


    public function updateStatus(Request $request)
    {
        $item = Menu::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }
}
