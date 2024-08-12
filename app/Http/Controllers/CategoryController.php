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
    public function index()
    {
        $categories = Category::orderByDesc('created_at')->paginate(10);
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
            return redirect(route('categories.index'))->with('success', 'Added Successfully');
        } catch (Exception $e) {
            return back()->with(['status' => false, 'error' => $e->getMessage()]);
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
            return redirect()->route('categories.index')->with('success', 'Updated Successfully');
        } catch (Exception $e) {
            return back()->with(['status' => false, 'error' => $e->getMessage()]);
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

        return redirect()->back()->with('success', 'Category deleted successfully.');
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
