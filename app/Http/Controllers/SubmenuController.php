<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\SubCategory;

class SubmenuController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $submenus = new Submenu();
        $submenus->name = $request->name;
        $submenus->category_id = $request->input('category');
        $submenus->subcategory_id = $request->input('subcategory');
        $submenus->submenu_id = $request->input('subcategory');
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique name
            $image->storeAs('assets/menu', $imageName, 'public'); // Store the image in assets/category
            $submenus->image = $imageName; // Save the unique name
        }
    
        $submenus->save();
        return redirect()->back()->with('success', 'Menu created successfully.');
    }

    public function fetchsubcategory($category_id = null) {
        $data = DB::table('sub_categories')->where('category_id', $category_id)->get();
        return response()->json([
            'status' => 1,
            'data' => $data
        ]);
    }
}
