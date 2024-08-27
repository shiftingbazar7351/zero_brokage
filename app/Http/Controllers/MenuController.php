<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Storage;
use Exception;

class MenuController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
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
        // Validate and store the new menu category
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'subcategory' => 'required',
            'image' => 'required|image|mimes:jpeg,png|max:2048',
        ]);
    
       
    
       
            $menu = new Menu();
            $menu->name = $request->name;
            $menu->subcategory_id = $request->subcategory;
            $menu->category_id = $request->category_id;
            $menu->slug = $this->generateSlug($request->name);
    
            if ($request->hasFile('image')) {
                $filename = $this->fileUploadService->uploadImage('menu/', $request->file('image'));
                $menu->image = $filename;
            }
    
            $menu->save();
    
            return response()->json(['success' => true, 'message' => 'Menu added successfully!']);      
    }
    

    protected function generateSlug($name)
    {
        $slug = str_replace(' ', '_', $name);
        $slug = strtolower($slug);
        return $slug;
    }
    public function edit($id)
    {
        $menus = Menu::find($id);
        return response()->json(['menu' => $menus]);
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|unique:menus,name,' . $menu->id,
            'category_id' => 'required',
            'subcategory' => 'required|integer|exists:menus,subcategory_id',
            'image' => 'required|image|mimes:jpeg,png|max:2048',
        ]);
    
    
            $menu->name = $request->name;
            $menu->subcategory_id = $request->subcategory;
            $menu->slug = $this->generateSlug($request->name);
    
            if ($request->hasFile('image')) {
                $filename = $this->fileUploadService->uploadImage('menu/', $request->file('image'));
                $menu->image = $filename;
            }
    
            $menu->save();
    
            return response()->json(['success' => true, 'message' => 'Menu updated successfully!']);
        
        }
    
    
    public function destroy($id)
    {
        try {
        $menu = Menu::findOrFail($id);

        $img = $menu->image;
        $menu->forceDelete();
        if ($img) {
        $this->fileUploadService->removeImage('menu/', $img);
        }

        $menu->delete();
        return redirect()->back()->with('success', 'Menu Deleted.');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


  


    public function menuStatus(Request $request)
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
