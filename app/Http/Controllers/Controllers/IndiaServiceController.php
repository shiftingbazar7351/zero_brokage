<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Menu;
use App\Models\SubCategory;
use App\Models\SubMenu;
use App\Models\IndiaServiceDescription;
use Illuminate\Http\Request;

class IndiaServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $query = IndiaServiceDescription::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }
        // Paginate the users (adjust pagination number as needed)
        $services = $query->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('backend.india-service-description.partials.india-index', compact('services'))->render();
        }
        return view('backend.india-service-description.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        return view('backend.india-service-description.create', compact('categories', 'subcategories', 'submenus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'menu_id' => 'required',
            'submenu_id' => 'required',
        ], [
            'description.required' => 'The description field is required.',
            'category_id.required' => 'Please select a category.',
            'sub_category_id.required' => 'Please select a subcategory.',
            'menu_id.required' => 'Please select a menu.',
            'submenu_id.required' => 'Please select a submenu.',
        ]);

        $india = IndiaServiceDescription::create($request->all());
        $india->created_by = auth()->id();

        return redirect(route('india-services.index'))->with(['message' => 'Added Successfully', 'alert-type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $categories = Category::where('status', 1)->orderByDesc('created_at')->get();
        $subcategories = SubCategory::orderByDesc('created_at')->get();
        $submenus = SubMenu::orderByDesc('created_at')->get();
        $services = IndiaServiceDescription::findOrFail($id);
        return view('backend.india-service-description.edit', compact('services','categories','subcategories','submenus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'menu_id' => 'required',
            'submenu_id' => 'required',
        ], [
            'description.required' => 'The description field is required.',
            'category_id.required' => 'Please select a category.',
            'sub_category_id.required' => 'Please select a subcategory.',
            'menu_id.required' => 'Please select a menu.',
            'submenu_id.required' => 'Please select a submenu.',
        ]);
        IndiaServiceDescription::findOrFail($id)->update($request->all());
        return redirect(route('india-services.index'))->with(['message' => 'Updated Successfully', 'alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {

        $service = IndiaServiceDescription::find($id);
        if ($service) {
            $service->delete();
            return redirect()->back()->with(['message' => 'Deleted Successfully', 'alert-type' => 'success']);
        } else {
            return redirect()->back()->with('error', 'Service not found');
        }
    }

}
