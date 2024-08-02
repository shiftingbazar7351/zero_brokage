<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'nullable|string|max:255', 
            'subcategory' => 'nullable|string|max:255', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->category_id = $request->input('category');
        $menu->subcategory_id = $request->input('subcategory');
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique name
            $image->storeAs('assets/menu', $imageName, 'public'); // Store the image in assets/category
            $menu->image = $imageName; // Save the unique name
        }
    
        $menu->save();
        return redirect()->back()->with('success', 'Menu created successfully.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        // Pass the menu item to the view for editing
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'nullable|string|max:255',
            'subcategory' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $menu = Menu::findOrFail($id);
        $menu->name = $request->name;
        $menu->category_id = $request->input('category');
        $menu->subcategory_id = $request->input('subcategory');
    
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($menu->image) {
                \Storage::disk('public')->delete('assets/menu/' . $menu->image);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique name
            $image->storeAs('assets/menu', $imageName, 'public'); // Store the image in assets/category
            $menu->image = $imageName; // Save the unique name
        }
    
        $menu->save();
        return redirect()->back()->with('success', 'Menu updated successfully.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        
        // Delete image if exists
        if ($menu->image) {
            \Storage::disk('public')->delete('assets/menu/' . $menu->image);
        }
        
        $menu->delete();
        return redirect()->back()->with('success', 'Menu deleted successfully.');
    }
}

