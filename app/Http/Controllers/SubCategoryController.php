<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Services\FileUploadService;
use Exception;
use Illuminate\Http\RedirectRedirectResponse;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $categories = Category::get();
        $subcategories = SubCategory::orderByDesc('created_at')->paginate(10);
        return view('backend.sub-category.index', compact('subcategories','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);
        $category = new SubCategory();
        $category->name = $request->name;
        $category->category_id = $request->category_id;
        $category->background_image = $request->background_image;
        $category->icon = $request->icon;
        $category->slug = generateSlug($request->name);

        if ($request->hasFile('background_image')) {
            $filename = $this->fileUploadService->uploadImage('background_image/', $request->file('background_image'));
            $category['background_image'] = $filename;
        }

        if ($request->hasFile('icon')) {
            $filename = $this->fileUploadService->uploadImage('icon/', $request->file('icon'));
            $category['icon'] = $filename;
        }
        $category->save();
        return redirect()->back()->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SubCategory $subcategory)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $subcategory->id,
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);
        $subcategory->name = $request->name;
        $subcategory->slug = generateSlug($request->name);
        if ($request->hasFile('background_image')) {
            $filename = $this->fileUploadService->uploadImage('background_image/', $request->file('background_image'));
            $subcategory['background_image'] = $filename;
        }
        if ($request->hasFile('icon')) {
            $filename = $this->fileUploadService->uploadImage('icon/', $request->file('icon'));
            $subcategory['icon'] = $filename;
        }
        $subcategory->save();
        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $subcategory = SubCategory::findOrFail($id);
            $old_background_image = $subcategory->background_image;
            $old_icon = $subcategory->icon;
            $subcategory->forceDelete();
            if ($old_background_image) {
                $this->fileUploadService->removeImage('background_image/', $old_background_image);
            }
            if ($old_icon) {
                $this->fileUploadService->removeImage('icon/', $old_icon);
            }
            return redirect()->back()->with('success' , 'Deleted Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function subCategoryStatus(Request $request)
    {
        $item = SubCategory::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();
            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }

}
