<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderByDesc('created_at')->get();
        return view('backend.category.index', compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            // 'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048', // Validate icon field as an image
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->image = $request->image;
        $category->icon = $request->icon;
        $category->slug = $this->generateSlug($request->name);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique name
            $image->storeAs('assets/category', $imageName, 'public'); // Store the image in assets/category
            $category->image = $imageName; // Save the unique name
        }

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '_' . $icon->getClientOriginalName(); // Generate unique name
            $icon->storeAs('assets/icon', $iconName, 'public'); // Store the icon in assets/icon
            $category->icon = $iconName; // Save the unique name
        }

        $category->save();

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    protected function generateSlug($name)
    {
        $slug = str_replace(' ', '_', $name);
        $slug = strtolower($slug);
        return $slug;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return response()->json(['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $category->name = $request->name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('assets/category', $imageName, 'public');
            $category->image = $imageName;
        }

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '_' . $icon->getClientOriginalName();
            $icon->storeAs('assets/icon', $iconName, 'public');
            $category->icon = $iconName;
        }

        $category->save();

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->image) {
            \Storage::delete('public/assets/category/' . $category->image);
        }
        if ($category->icon) {
            \Storage::delete('public/assets/icon/' . $category->icon);
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->status = $request->input('status', 0);
        $category->save();

        return redirect()->back()->with('success', 'Status updated successfully');
    }


}
