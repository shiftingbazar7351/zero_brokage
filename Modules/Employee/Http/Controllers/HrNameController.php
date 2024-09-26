<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employee\Entities\HrName;

class HrNameController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = HrName::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
            // $query->where('address', 'like', '%' . $request->search . '%');
        }
        // Paginate the users (adjust pagination number as needed)
        $hrs = $query->orderByDesc('created_at')->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('employee::hr.partials.hr-index', compact('hrs'))->render();
        }
        return view('employee::hr.index',compact('hrs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('employee::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'designation'   => 'required',
            'name'          => 'required',
        ]);

        $hr = new HrName();
        $hr->designation = $request->designation;
        $hr->name = $request->name;

        $hr->save();

        return response()->json(['success' => true, 'message' => 'HR created successfully.']);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('employee::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $hr = HrName::find($id);
        return response()->json(['hr' => $hr]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $hr = HrName::findOrFail($id);

        $request->validate([
            'designation'   => 'required',
            'name'          => 'required',
        ]);

        $hr->designation = $request->designation;
        $hr->name = $request->name;

        $hr->save();

        return response()->json(['success' => true, 'message' => 'HR updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {

        $hr = HrName::findOrFail($id);
        $hr->delete();

        return back()->with(['message' => 'HR deleted successfully.', 'alert-type' => 'success']);

    }

    public function hrStatus(Request $request)
    {
        $item = HrName::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();
            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }
}
