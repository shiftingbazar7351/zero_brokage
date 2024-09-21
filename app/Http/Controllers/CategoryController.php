<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        // Paginate the users (adjust pagination number as needed)
        $categories = $query->orderByDesc('created_at')->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('backend.category.partials.category-index', compact('categories'))->render();
        }
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $slug = generateSlug($request->name);
            $data = array_merge($request->validated(), ['slug' => $slug]);
            Category::create($data);
            session()->flash('success', 'Added Successfully');
            return response()->json(['success' => true, 'message' => 'Category added successfully']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
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
    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $slug = generateSlug($request->name);
            $data = array_merge($request->validated(), ['slug' => $slug]);
            $category->update($data);
            return response()->json(['success' => true, 'message' => 'Category updated successfully']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::delete('public/assets/category/' . $category->image);
        }
        if ($category->icon) {
            Storage::delete('public/assets/icon/' . $category->icon);
        }

        $category->delete();

        return back()->with(['message' => 'Category deleted successfully.', 'alert-type' => 'success']);

    }

    public function categoryStatus(Request $request)
    {
        $item = Category::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }


}
