<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Services\FileUploadService;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Http\RedirectRedirectResponse;
use Illuminate\Http\Request;
use App\Models\State;

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
     */
    public function index(Request $request)
    {
        $query = SubCategory::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
            ->orderByDesc('created_at');
        }
        // Paginate the users (adjust pagination number as needed)
        $subcategories = $query->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('backend.sub-category.partials.subcategory-index', compact('subcategories'))->render();
        }
        $categories = Category::get();
        // $subcategories = SubCategory::with('categoryName')->orderByDesc('created_at')->paginate(10);
        return view('backend.sub-category.index', compact('subcategories','categories'));
    }


    public function store(Request $request)
    {
        // 'required|file|mimetypes:image/jpeg,image/png,image/gif,image/svg+xml,image/webp,image/heif,image/heic'

        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:sub_categories|max:255',
            'background_image' => 'required|image|max:2048',
            'icon' => 'required|image|max:2048',
        ]);


        $subcategory = new SubCategory();
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->slug = generateSlug($request->name);
        $subcategory->trending = $request->has('trending') ? 1 : 0;
        $subcategory->featured = $request->has('featured') ? 1 : 0;

        if ($request->hasFile('background_image')) {
            $filename = $this->fileUploadService->uploadImage('background_image/', $request->file('background_image'));
            $subcategory->background_image = $filename;
        }

        if ($request->hasFile('icon')) {
            $filename = $this->fileUploadService->uploadImage('icon/', $request->file('icon'));
            $subcategory->icon = $filename;
        }

        $subcategory->save();

        return response()->json(['success' => true, 'message' => 'Subcategory created successfully.']);
    }




    public function edit(SubCategory $subcategory)
    {
        return response()->json([
            'subcategory' => [
                'id' => $subcategory->id,
                'category_id' => $subcategory->category_id,
                'name' => $subcategory->name,
                'icon' => $subcategory->icon,
                'background_image' => $subcategory->background_image,
                'trending' => $subcategory->trending,
                'featured' => $subcategory->featured,
            ]
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, SubCategory $subcategory)
    {
        $request->validate([
            'category_id' => 'required',
            // 'name' => 'required|exists:sub_categories,$subcategory->id',
            'name' => [
                'required',
                'max:255',
                Rule::unique('sub_categories')->ignore($subcategory->id)
            ],
            'background_image' => 'nullable|image|max:2048',
            'icon' => 'nullable|image|max:2048',
        ]);


        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->slug = generateSlug($request->name);
        $subcategory->trending = $request->has('trending') ? 1 : 0;
        $subcategory->featured = $request->has('featured') ? 1 : 0;


        if ($request->hasFile('icon')) {
            $filename = $this->fileUploadService->uploadImage('icon/', $request->file('icon'));
            $subcategory->icon = $filename;
        }

        if ($request->hasFile('background_image')) {
            $filename = $this->fileUploadService->uploadImage('background_image/', $request->file('background_image'));
            $subcategory->background_image = $filename;
        }

        $subcategory->save();

        return response()->json(['success' => true, 'message' => 'Subcategory updated successfully.']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
            return redirect()->back()->with(['message' => 'Deleted Successfully', 'alert-type' => 'success']);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => 'Something went wrong', 'alert-type' => 'error']);
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
